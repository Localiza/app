<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Http\Requests;
use guialocaliza\Http\Controllers\Controller;

use guialocaliza\Banners;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BannersController extends Controller
{

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$banners = Banners::latest()->get();
		return view('banners.index', compact('banners'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('banners.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//$this->validate($request, ['name' => 'required']); // Uncomment and modify if needed.
		$banner = Banners::create($request->all());
        if($request->file('imagem')) {
            $imageName = $banner->id . '_banner.' . $request->file('imagem')->getClientOriginalExtension();
            $request->file('imagem')->move(
                base_path() . '/public/uploads/empresas/banners/', $imageName
            );
            $banner->imagem = $imageName;
            $banner->save();
            Image::make(sprintf(base_path() . '/public/uploads/empresas/banners/%s', $imageName))->resize(370, 120)->save();
        }
		return redirect('empresa/'.$banner->empresa_id.'/assets');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$banner = Banners::findOrFail($id);
		return view('banners.show', compact('banner'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$banner = Banners::findOrFail($id);
		return view('banners.edit', compact('banner'));
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
		$banner = Banners::findOrFail($id);
		$banner->update($request->all());
		return redirect('banners');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Banners::destroy($id);
		return redirect('banners');
	}

}
