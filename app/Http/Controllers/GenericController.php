<?php

namespace guialocaliza\Http\Controllers;

use guialocaliza\Categorias;
use guialocaliza\Http\Requests;

class GenericController extends Controller
{


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($controller,$field,$value,$parentfield=null,$parentvalue=null)
	{
		$classe = "guialocaliza\\$controller";
        if($parentfield == null) {
            $obj = $classe::create(array($field => $value));
        }else{
            $obj = $classe::create(array($parentfield => $parentvalue, $field => $value));
        }
        if($obj) {
            $return = array(
                'id' => $obj->id
            );
            die(json_encode($return));
        }
	}


}
