<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Planos;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlanoController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$planos = Planos::latest()->get();
		return view('plano.index', compact('planos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('plano.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		Planos::create($request->all());
		return redirect('plano');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$plano = Planos::findOrFail($id);
		return view('plano.show', compact('plano'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$plano = Planos::findOrFail($id);
		return view('plano.edit', compact('plano'));
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
		$plano = Planos::findOrFail($id);
		$plano->update($request->all());
		return redirect('plano');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Planos::destroy($id);
		return redirect('plano');
	}

    public function active($id){
        $cidade = Planos::findOrFail($id);
        $teste = $cidade->active;
        $cidade->update([
            'active'=> !$teste
        ]);
    }

}
