<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Subcategorias extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'subcategorias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['categoria_id', 'nome'];

    public function categoria(){
        return $this->belongsTo('guialocaliza\Categorias', 'categoria_id');
    }

}
