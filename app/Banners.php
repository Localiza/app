<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Banners extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'banners';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['empresa_id', 'tipo', 'imagem', 'ext'];

}
