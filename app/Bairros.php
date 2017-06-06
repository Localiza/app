<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Bairros extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'bairros';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['cidade_id', 'name', 'active'];

}
