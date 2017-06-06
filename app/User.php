<?php

namespace guialocaliza;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * Definição da tabela usada por esse model.
     *
     * @table string
     */
    protected $table = 'users';

    /**
     * Os atributos que podem ser atribuidos.
     *
     * @fillable array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * Os atributos excluídos do formulário JSON do model.
     *
     * @hidden array
     */
    protected $hidden = ['password', 'remember_token'];
}
