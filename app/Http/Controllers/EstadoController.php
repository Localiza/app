<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Estados;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EstadoController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$estados = Estados::latest()->get();
		return view('estado.index', compact('estados'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('estado.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Estados::create($request->all());
		return redirect('estado');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$estado = Estados::findOrFail($id);
		return view('estado.show', compact('estado'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$estado = Estados::findOrFail($id);
		return view('estado.edit', compact('estado'));
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
		$estado = Estados::findOrFail($id);
		$estado->update($request->all());
		return redirect('estado');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Estados::destroy($id);
		return redirect('estado');
	}

    public function active($id){
        $estado = Estados::findOrFail($id);
        $teste = $estado->active;
        $estado->update([
            'active'=> !$teste
        ]);
    }

}
