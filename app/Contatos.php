<?php namespace guialocaliza;

use Illuminate\Database\Eloquent\Model;

class Contatos extends Model  {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'contatos';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['nome', 'email', 'telefone', 'mensagem'];

}
