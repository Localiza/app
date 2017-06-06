<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Estados;
use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Contatos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ContatoController extends Controller
{


    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$contatos = Contatos::latest()->get();
		return view('contato.index', compact('contatos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $ufs      = Estados::where('active',1)->get();
        return view('contato.create', compact('ufs'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Contatos::create($request->all());
		return redirect('contato/create');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$contato = Contatos::findOrFail($id);
		return view('contato.show', compact('contato'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$contato = Contatos::findOrFail($id);
		return view('contato.edit', compact('contato'));
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
		$contato = Contatos::findOrFail($id);
		$contato->update($request->all());
		return redirect('contato');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Contatos::destroy($id);
		return redirect('contato');
	}

}
