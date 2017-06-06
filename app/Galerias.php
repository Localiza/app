<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Galerias extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'galerias';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['empresa_id', 'imagem', 'ext'];

}
