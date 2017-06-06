<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categorias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

    public function subcategorias(){
        return $this->hasMany('guialocaliza\Subcategorias','categoria_id');
    }


}
