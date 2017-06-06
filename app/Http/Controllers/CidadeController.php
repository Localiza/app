<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Estados;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Cidades;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CidadeController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$cidades = Cidades::all();
		return view('cidade.index', compact('cidades'));
	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('cidade.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Cidades::create($request->all());
		return redirect('cidade');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cidade = Cidades::findOrFail($id);
		return view('cidade.show', compact('cidade'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cidade = Cidades::findOrFail($id);
		return view('cidade.edit', compact('cidade'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$cidade = Cidades::findOrFail($id);
		$cidade->update($request->all());

        if($request->file('imagem')) {
            $cidade = Cidades::findOrFail($id);
            $imageName = $cidade->id . '.' . $request->file('imagem')->getClientOriginalExtension();
            $request->file('imagem')->move(
                base_path() . '/public/uploads/cidades/', $imageName
            );
            $cidade->imagem = $imageName;
            $cidade->update();
        }
		return redirect('cidade/lista/'.$cidade->estado_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Cidades::destroy($id);
		return redirect('cidade');
	}


    public function active($id){
        $cidade = Cidades::findOrFail($id);
        $teste = $cidade->active;
        $cidade->update([
            'active'=> !$teste
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function filtro()
    {
        $estados = Estados::all();
        return view('cidade.filtro', compact('estados'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function lista($id)
    {
        $cidades = Cidades::where('estado_id', $id)->orderBy('name')->get();
        $estado = Estados::findOrFail($id);
        return view('cidade.index', compact('cidades'))->with('estado',$estado);
    }

    public function json($id)
    {
        $cidades = Cidades::where('estado_id', $id)->where('active', 1)->orderBy('name')->get();
        print (json_encode($cidades));
    }

	public function load_citys($id)
	{
		$cidades = Cidades::where('estado_id', $id)->orderBy('name')->get();
		print (json_encode($cidades));
	}
}
