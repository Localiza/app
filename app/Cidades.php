<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Cidades extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cidades';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['estado_id', 'name','imagem', 'active'];

    public function estado()
    {
        return $this->belongsTo(\guialocaliza\Estados::class);
    }

}
