<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Galerias;
use Illuminate\Http\Request;
use Carbon\Carbon;

class GaleriaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$galerias = Galerias::latest()->get();
		return view('galeria.index', compact('galerias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('galeria.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Galerias::create($request->all());
		return redirect('galeria');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$galerium = Galerias::findOrFail($id);
		return view('galeria.show', compact('galerium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$galerium = Galerias::findOrFail($id);
		return view('galeria.edit', compact('galerium'));
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
		$galerium = Galerias::findOrFail($id);
		$galerium->update($request->all());
		return redirect('galeria');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Galerias::destroy($id);
		return redirect('galeria');
	}

}
