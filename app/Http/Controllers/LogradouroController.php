<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Cidades;
use guialocaliza\Estados;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Logradouros;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LogradouroController extends Controller
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
        return view('logradouro.create',compact('estados'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$log = Logradouros::create($request->all());
        return redirect("logradouro/lista/".$log->cidade_id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$logradouro = Logradouros::findOrFail($id);
		return view('logradouro.show', compact('logradouro'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$logradouro = Logradouros::findOrFail($id);
		return view('logradouro.edit', compact('logradouro'));
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
		$logradouro = Logradouros::findOrFail($id);
		$logradouro->update($request->all());
        return redirect("logradouro/lista/".$logradouro->cidade_id);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $logradouro = Logradouros::findOrFail($id);
        $logradouro->destroy($id);
        return redirect("logradouro/lista/".$logradouro->cidade_id);
	}


    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function filtro()
    {
        $estados = Estados::all();
        return view('logradouro.filtro', compact('estados'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function lista($id)
    {
        $dados = Logradouros::where('cidade_id', $id)->get();
        return view('logradouro.index', compact('dados'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function listacidades($id)
    {
        $cidades = Cidades::where('estado_id', $id)->where('active', 1)->get();
        $tmp = json_encode($cidades);
        print($tmp);
    }
}
