<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('empresas', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('categoria_id');
                $table->integer('subcategoria_id');
                $table->string('name');
                $table->string('logo');
                $table->integer('plano_id');
                $table->string('phone1');
                $table->string('phone2');
                $table->string('email');
                $table->integer('estado_id');
                $table->integer('cidade_id');
                $table->integer('cep_id');
                $table->integer('logradouro_id');
                $table->string('numero');
                $table->integer('bairro_id');
                $table->text('description');
                $table->string('website');
                $table->string('facebook');
                $table->string('twitter');
                $table->string('google');
                $table->text('tags');
                $table->integer('click');
                $table->integer('active');
                $table->timestamps();
            });
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('empresas');
    }
}
