<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Categorias;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Subcategorias;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SubcategoriaController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$subcategorias = Subcategorias::all();
		return view('subcategoria.index', compact('subcategorias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $categorias = Categorias::lists('name','id');
        return view('subcategoria.create', compact('categorias'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Subcategorias::create($request->all());
		return redirect('subcategoria');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$subcategorium = Subcategorias::findOrFail($id);
		return view('subcategoria.show', compact('subcategorium'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $categorias = Categorias::lists('name','id');
        $subcategorium = Subcategorias::findOrFail($id);
		return view('subcategoria.edit', compact('subcategorium','categorias'));
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
		$subcategorium = Subcategorias::findOrFail($id);
		$subcategorium->update($request->all());
		return redirect('subcategoria');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Subcategorias::destroy($id);
		return redirect('subcategoria');
	}

    public function getList($cat){
        $subcategoria  = Subcategorias::where('categoria_id', $cat)->lists('nome','id');
        die(json_encode($subcategoria));
    }

}
