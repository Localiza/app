<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Bairros;
use guialocaliza\Banners;
use guialocaliza\Categorias;
use guialocaliza\Ceps;
use guialocaliza\Cidades;
use guialocaliza\Estados;
use guialocaliza\Galerias;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Requests\EmpresaRequest;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Empresas;
use guialocaliza\Logradouros;
use guialocaliza\Planos;
use guialocaliza\Subcategorias;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class EmpresaController extends Controller
{
    private $request;

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
        $ufs = Estados::all();
        $categories = Categorias::all();
        if($request){
            $this->request = $request;
            $empresas = Empresas::where('name', 'like', "%".$this->request->empresa."%")->where(function($query){
                $tmp = $query;
                    $this->request->plano > 0 ? $tmp->where('plano_id', $this->request->plano) :null;
                    $this->request->categoria > 0 ? $tmp->where('categoria_id', $this->request->categoria) :null;
                    $this->request->uf > 0 ? $tmp->where('estado_id', $this->request->uf) :null;
                    $this->request->cidade > 0 ? $tmp->where('cidade_id', $this->request->cidade) :null;
                    $this->request->phone !="" ? $tmp->where('phone1', $this->request->phone) :null;
                return $tmp;
            })->paginate(100);
        }else {
            $empresas = Empresas::paginate(100);
        }
        return view('empresa.index', compact('empresas', 'ufs', 'categories'));
	}

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function assets($id)
	{
        $empresa = Empresas::findOrFail($id);
        $galeria = Galerias::where('empresa_id',$id)->get();
        $banners = Banners::where('empresa_id',$id)->get();
		return view('empresa.assets', compact('empresa','galeria','banners'));
	}

    public function assetsDel($id)
    {
        if(Galerias::destroy($id)){
            return "1";
        }else{
            return "0";
        }
    }

    public function bannerDel($id)
    {
        if(Banners::destroy($id)){
            return "1";
        }else{
            return "0";
        }
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categorias = Categorias::orderBy('name')->lists('name','id');
        $planos     = Planos::orderBy('name')->lists('name','id');
        $ufs        = Estados::where('active','1')->lists('uf','id');
        return view('empresa.create', compact('categorias','planos','ufs'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(EmpresaRequest $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$empresa = Empresas::create($request->all());
        if($request->file('logo')) {
            $imageName = $empresa->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(
                base_path() . '/public/uploads/empresas/', $imageName
            );
            $empresa->logo = $imageName;
            $empresa->save();
        }

		return redirect('empresa');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$empresa = Empresas::findOrFail($id);
		return view('empresa.show', compact('empresa'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$empresa = Empresas::findOrFail($id);

        $categorias      = Categorias::findOrFail($empresa->categoria_id)->orderBy('name')->lists('name','id');
        $subcategorias   = Subcategorias::where('categoria_id',$empresa->categoria_id)->orderBy('nome')->lists('nome','id');
        $estados         = Estados::findOrFail($empresa->estado_id)->lists('name','id');
        $cidades         = Cidades::where('estado_id',$empresa->estado_id)->where('active',1)->orderBy('name')->lists('name','id');
        $ceps            = Ceps::where('cidade_id',$empresa->cidade_id)->orderBy('name')->lists('name','id');
        $logradouros     = Logradouros::where('cidade_id',$empresa->cidade_id)->orderBy('name')->lists('name','id');
        $bairros         = Bairros::where('cidade_id',$empresa->cidade_id)->orderBy('name')->lists('name','id');
        $planos          = Planos::lists('name','id');

		return view('empresa.edit', compact('empresa','categorias','subcategorias','planos','estados','cidades','ceps','logradouros','bairros'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, EmpresaRequest $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$empresa = Empresas::findOrFail($id);
        $empresa->update($request->all());
        $empresa = Empresas::findOrFail($id);
        if($request->file('logo')) {
            $imageName = $empresa->id . '.' . $request->file('logo')->getClientOriginalExtension();
            $request->file('logo')->move(
                base_path() . '/public/uploads/empresas/', $imageName
            );
            $empresa->logo = $imageName;
            $empresa->update();
        }

		return redirect('empresa');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Empresas::destroy($id);
		return redirect('empresa');
	}


    public function active($id){
        $cidade = Empresas::findOrFail($id);
        $teste = $cidade->active;
        $cidade->update([
            'active'=> !$teste
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function ceps($id)
    {
        $regs = Ceps::where('cidade_id', $id)->orderBy('name')->get();
        $tmp = json_encode($regs);
        print($tmp);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function logradouros($id)
    {
        $regs = Logradouros::where('cidade_id', $id)->orderBy('name')->get();
        $tmp = json_encode($regs);
        print($tmp);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function bairros($id)
    {
        $regs = Bairros::where('cidade_id', $id)->orderBy('name')->get();
        $tmp = json_encode($regs);
        print($tmp);
    }

    public function uploadGaleria($id, Request $request){
        $empresa = Empresas::findOrFail($id);

        $galeria = Galerias::create([
            'empresa_id' => $empresa->id,
        ]);
        if($request->file('file')) {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imageName = $galeria->id.time() . '.' . $ext;
            $request->file('file')->move(
                base_path() . '/public/uploads/empresas/'.$empresa->id.'/galeria/', $imageName
            );
            $galeria->imagem = $imageName;
            $galeria->ext = $ext;
            $galeria->save();

            Image::make(sprintf(base_path() . '/public/uploads/empresas/'.$empresa->id.'/galeria/%s', $imageName))->resize(null, 480,function ($constraint) {
                $constraint->aspectRatio();
            })->save();

        }
    }

}
