<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Empresas extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'empresas';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categoria_id',
        'subcategoria_id',
        'name',
        'logo',
        'plano_id',
        'phone1',
        'phone2',
        'email',
        'estado_id',
        'cidade_id',
        'cep_id',
        'logradouro_id',
        'numero',
        'bairro_id',
        'description',
        'website',
        'facebook',
        'twitter',
        'google',
        'tags',
        'click',
        'active'
    ];

    public function cidade(){
        return $this->belongsTo('guialocaliza\Cidades','cidade_id');
    }
    public function uf(){
        return $this->belongsTo('guialocaliza\Estados','estado_id');
    }
    public function plano(){
        return $this->belongsTo('guialocaliza\Planos','plano_id');
    }

    public function rua(){
        return $this->belongsTo('guialocaliza\Logradouros','logradouro_id');
    }
    public function bairro(){
        return $this->belongsTo('guialocaliza\Bairros','bairro_id');
    }

    public function cep(){
        return $this->belongsTo('guialocaliza\Ceps','cep_id');
    }

}
