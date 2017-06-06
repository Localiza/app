<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Http\Requests;
use guialocaliza\Cidades;
use guialocaliza\Empresas;


class MobileController extends Controller
{
	private $busca;


	public function allCity()
	{
		$citys = Cidades::join('estados','estados.id','=','cidades.estado_id')->orderBy('cidades.name')->get(array('cidades.*','estados.uf'));
		return json_encode($citys);
	}

	public function searchPhones($cidade,$tag)
	{
		$this->busca = $tag;
		$todas 	= Empresas::where('empresas.cidade_id',$cidade)->orderBy('empresas.name')
                ->where('empresas.active',1)->where(function($query){
                return $query->where('empresas.tags', 'like', "%" . $this->busca . "%")->orWhere('empresas.name', 'like', "%" . $this->busca . "%")
                    ->orWhere('categorias.name', 'like', "%" . $this->busca . "%");
            })->join('categorias', 'categorias.id', '=', 'empresas.categoria_id')->get(array('empresas.*'));
		return json_encode($todas);
	}
	
	public function allPhones($cidade){
		$todas 	= Empresas::where('empresas.cidade_id',$cidade)->get();
		return json_encode($todas);
	}
}

?> 