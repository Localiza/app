<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Cidades;
use guialocaliza\Estados;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Bairros;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BairroController extends Controller
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
        return view('bairro.create',compact('estados'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$bairro = Bairros::create($request->all());
        return redirect("bairro/lista/".$bairro->cidade_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$bairro = Bairros::findOrFail($id);
		return view('bairro.show', compact('bairro'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $bairro = Bairros::findOrFail($id);
		return view('bairro.edit', compact('bairro'));
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
		$bairro = Bairros::findOrFail($id);
		$bairro->update($request->all());
		return redirect("bairro/lista/".$bairro->cidade_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $bairro = Bairros::findOrFail($id);
        $bairro->destroy($id);
        return redirect("bairro/lista/".$bairro->cidade_id);
	}

    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function filtro()
    {
        $estados = Estados::all();
        return view('bairro.filtro', compact('estados'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function lista($id)
    {
        $dados = Bairros::where('cidade_id', $id)->get();
        return view('bairro.index', compact('dados'));
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
