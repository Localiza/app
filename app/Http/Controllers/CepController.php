<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Cidades;
use guialocaliza\Estados;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Ceps;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CepController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$this->filtro();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $estados = Estados::all();
        return view('cep.create',compact('estados'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$cep = Ceps::create($request->all());
        return redirect("cep/lista/".$cep->cidade_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$cep = Ceps::findOrFail($id);
		return view('cep.show', compact('cep'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$cep = Ceps::findOrFail($id);
		return view('cep.edit', compact('cep'));
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
		$cep = Ceps::findOrFail($id);
		$cep->update($request->all());
        return redirect("cep/lista/".$cep->cidade_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $cep = Ceps::findOrFail($id);
        $cep->destroy($id);
        return redirect("cep/lista/".$cep->cidade_id);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function filtro()
    {
        $estados = Estados::all();
        return view('cep.filtro', compact('estados'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function lista($id)
    {
        $dados = Ceps::where('cidade_id', $id)->orderBy('name')->get();
        return view('cep.index', compact('dados'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function listacidades($id)
    {
        $cidades = Cidades::where('estado_id', $id)->where('active', 1)->orderBy('name')->get();
        $tmp = json_encode($cidades);
        print($tmp);
    }

}
