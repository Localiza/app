<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'estados';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uf', 'name', 'active'];

}
