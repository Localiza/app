<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Planos extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'planos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'value', 'active'];

}
