@extends('layouts.master')

@section('content')


    <div class="panel">
        <div class="panel-body">
            <h1>Nova Empresa</h1>
            <hr>
            @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        {!! Form::open(['url' => 'empresa', 'class' => 'form-horizontal','files' => true]) !!}
            <div class="col-md-12"><h3>Dados Gerais</h3></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        {!! Form::file('logo', null) !!}
                    </div>

                <div class="col-md-9">
                    <div class="col-md-12">
                        <div class="input-group padding5">
                            <span class="input-group-addon">Nome da empresa:</span>
                            {!! Form::text('name', null, ['class' => 'form-control','placeholder' => 'Nome da empresa']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group padding5">
                            <span class="input-group-addon">Categoria:</span>
                            {!! Form::select('categoria_id', $categorias, null, array('class' => 'form-control','id' => 'categoria_id','onChange' => 'getSubCats()')) !!}
                            <span class="input-group-btn">
                              <a href="#addNewRegistersModal" data-toggle="modal" data-controller-name="Categorias" data-select-id="categoria_id" data-field-name="name" data-parent-id="-1" data-parent-field="-1">
                                <button type="button" class="btn btn-success">+</button>
                              </a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group padding5">
                            <span class="input-group-addon">Sub-categoria:</span>
                            {!! Form::select('subcategoria_id', [], null, array('class' => 'form-control','id' => 'subcategoria_id')) !!}
                            <span class="input-group-btn">
                              <a href="#addNewRegistersModal" data-toggle="modal" data-controller-name="Subcategorias" data-select-id="subcategoria_id" data-field-name="nome" data-parent-id="categoria_id" data-parent-field="categoria_id">
                                  <button type="button" class="btn btn-success">+</button>
                              </a>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group padding5">
                            <span class="input-group-addon">Plano:</span>
                            {!! Form::select('plano_id', $planos, null, array('class' => 'form-control','id' => 'plano_id')) !!}
                        </div>
                    </div>
                </div>
            </div>

            </div>
            <div class="col-md-12"><h3>Contato</h3></div>
            <div class="row">
                <div class="col-md-4">
                    <div class="input-group padding5">
                        <span class="input-group-addon">Telefone 01:</span>
                        {!! Form::text('phone1', null, ['class' => 'form-control phone','placeholder' => 'Telefone 01']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group padding5">
                        <span class="input-group-addon">Telefone 02:</span>
                        {!! Form::text('phone2', null, ['class' => 'form-control phone','placeholder' => 'Telefone 02']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group padding5">
                        <span class="input-group-addon">E-mail:</span>
                        {!! Form::text('email', null, ['class' => 'form-control','placeholder' => 'Email']) !!}
                    </div>
                </div>
            </div>
            <div class="col-md-12"><h3>Localização</h3></div>
            <div class="row">
                <div class="col-md-2">
                    <div class="input-group padding5">
                        <span class="input-group-addon">UF:</span>
                        {!! Form::select('estado_id', $ufs, null, array('placeholder' => 'Selecione','class' => 'form-control','id' => 'estado_id','onChange' => 'getCitys()')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group padding5 cidades" style="display: none;">
                        <span class="input-group-addon">Cidade:</span>
                        {!! Form::select('cidade_id', [], null, array('placeholder' => 'Selecione','class' => 'form-control','id' => 'cidade_id','onChange' => 'getAll()')) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group padding5 ceps" style="display: none;">
                        <span class="input-group-addon">CEP:</span>
                        {!! Form::select('cep_id', [], null, array('placeholder' => 'Selecione','class' => 'form-control','id' => 'cep_id')) !!}
                        <span class="input-group-btn">
                          <a href="#addNewRegistersModal" data-toggle="modal" data-controller-name="Ceps" data-select-id="cep_id" data-field-name="name" data-parent-id="cidade_id" data-parent-field="cidade_id">
                              <button type="button" class="btn btn-success">+</button>
                          </a>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group padding5 logradouros" style="display: none;">
                        <span class="input-group-addon ">Rua:</span>
                        {!! Form::select('logradouro_id', [], null, array('placeholder' => 'Selecione','class' => 'form-control','id' => 'logradouro_id')) !!}
                        <span class="input-group-btn">
                          <a href="#addNewRegistersModal" data-toggle="modal" data-controller-name="Logradouros" data-select-id="logradouro_id" data-field-name="name" data-parent-id="cidade_id" data-parent-field="cidade_id">
                              <button type="button" class="btn btn-success">+</button>
                          </a>
                        </span>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="input-group padding5">
                        <span class="input-group-addon">Número:</span>
                        {!! Form::text('numero', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group padding5 bairros" style="display: none;">
                        <span class="input-group-addon">Bairro:</span>
                        {!! Form::select('bairro_id', [], null, array('placeholder' => 'Selecione','class' => 'form-control','id' => 'bairro_id')) !!}
                        <span class="input-group-btn">
                          <a href="#addNewRegistersModal" data-toggle="modal" data-controller-name="Bairros" data-select-id="bairro_id" data-field-name="name" data-parent-id="cidade_id" data-parent-field="cidade_id">
                              <button type="button" class="btn btn-success">+</button>
                          </a>
                        </span>
                    </div>
                </div>

            </div>
            <div class="col-md-12"><h3>Social</h3></div>
            <div class="row">
                <div class="col-md-3">
                    <div class="input-group padding5">
                        <span class="input-group-addon">@</span>
                        {!! Form::text('twitter', null, ['class' => 'form-control','placeholder' => 'Twitter']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group padding5">
                        <span class="input-group-addon">http://</span>
                        {!! Form::text('website', null, ['class' => 'form-control','placeholder' => 'Website']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group padding5">
                        <span class="input-group-addon"><i class="fa fa-facebook"></i> </span>
                        {!! Form::text('facebook', null, ['class' => 'form-control','placeholder' => 'Facebook']) !!}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group padding5">
                        <span class="input-group-addon"><i class="fa fa-google-plus"></i> </span>
                        {!! Form::text('google', null, ['class' => 'form-control','placeholder' => 'Google plus']) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12"><h3>Parâmetros</h3></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group padding5">
                        {!! Form::textarea('description', null, ['class' => 'form-control','placeholder' => 'descrição da empresa']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group padding5">
                        {!! Form::text('tags', null, ['class' => 'form-control','placeholder' => 'tag1,tag2,tag3']) !!}
                    </div>
                    <div class="col-md-2">
                        <div class="input-group ">
                            <span class="input-group-addon"><i class="fa fa-mouse-pointer"></i> </span>
                            {!! Form::text('click', 0, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="input-group ">
                            {!! Form::text('active', 1, ['class' => 'form-control activeEmpresa','style'=>'display:none']) !!}
                            <div class="toggle-wrapper">
                                <div class="toggle toggle-modern success ativar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function getSubCats(){
                    var from2  = $("#categoria_id").val();
                    var cmd = $("#subcategoria_id");
                    cmd.empty();
                    $.ajax({
                        url: "/subcategoria/list/"+from2.toString(),
                        type: 'GET',
                        dataType: 'json',
                        success: function (rs) {
                            $.each(rs,function(index, value){
                                cmd.append('<option value="'+index+'">'+value+'</option>');
                            });
                        }
                    });
                }
                function getCitys(){
                    var id = $('#estado_id').val();
                    $.ajax({
                        url: "/cep/listacidades/"+id,
                        type: 'GET',
                        dataType: 'html',
                        success: function (result) {
                            var rs      = JSON.parse(result);
                            var list    = $('#cidade_id');
                            list.empty();
                            list.append('<option>Selecione</option>');
                            rs.forEach( function( item ) {
                                var tmp = '<option value="'+item.id+'">'+item.name+'</option>';
                                list.append(tmp);
                            });
                            list.fadeIn(300);
                            $('.cidades').fadeIn(300);
                        }
                    });
                }

                function getAll(){
                    var id = $('#cidade_id').val();
                    $.ajax({
                        url: "/empresa/ceps/"+id,
                        type: 'GET',
                        dataType: 'html',
                        success: function (result) {
                            var rs      = JSON.parse(result);
                            var list    = $('#cep_id');
                            list.empty();
                            list.append('<option>Selecione</option>');
                            rs.forEach( function( item ) {
                                var tmp = '<option value="'+item.id+'">'+item.name+'</option>';
                                list.append(tmp);
                            });
                            list.fadeIn(300);
                            $('.ceps').fadeIn(300);
                        }
                    });
                    $.ajax({
                        url: "/empresa/logradouros/"+id,
                        type: 'GET',
                        dataType: 'html',
                        success: function (result) {
                            var rs      = JSON.parse(result);
                            var list    = $('#logradouro_id');
                            list.empty();
                            list.append('<option>Selecione</option>');
                            rs.forEach( function( item ) {
                                var tmp = '<option value="'+item.id+'">'+item.name+'</option>';
                                list.append(tmp);
                            });
                            list.fadeIn(300);
                            $('.logradouros').fadeIn(300);
                        }
                    });
                    $.ajax({
                        url: "/empresa/bairros/"+id,
                        type: 'GET',
                        dataType: 'html',
                        success: function (result) {
                            var rs      = JSON.parse(result);
                            var list    = $('#bairro_id');
                            list.empty();
                            list.append('<option>Selecione</option>');
                            rs.forEach( function( item ) {
                                var tmp = '<option value="'+item.id+'">'+item.name+'</option>';
                                list.append(tmp);
                            });
                            list.fadeIn(300);
                            $('.bairros').fadeIn(300);
                        }
                    });
                }

                $('.ativar').toggles({
                    on: 1,
                    text: {
                        on: 'ATV', // text for the ON position
                        off: 'OFF' // and off
                    },
                    height: 26,
                    width:100
                }).on('toggle', function (e, active) {
                    var tmp   =  active ? 1 :0;
                    $(".activeEmpresa").val(tmp);
                });
            </script>

                <hr>
                <div class="form-group padding5">
                    <div class="col-sm-3 pull-right">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-success form-control']) !!}
                    </div>
                </div>

    </div>
    {!! Form::close() !!}

    {!! View::make('empresa.modals') !!}



@endsection
