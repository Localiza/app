<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Categorias;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoriaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categorias = Categorias::latest()->get();
		return view('categoria.index', compact('categorias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categoria.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Categorias::create($request->all());
		return redirect('categoria');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$categorium = Categorias::findOrFail($id);
		return view('categoria.show', compact('categorium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$categorium = Categorias::findOrFail($id);
		return view('categoria.edit', compact('categorium'));
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
		$categorium = Categorias::findOrFail($id);
		$categorium->update($request->all());
		return redirect('categoria');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Categorias::destroy($id);
		return redirect('categoria');
	}

}
