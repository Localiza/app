@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>UF/Cidade</h1>
            <h3>Selecione um estado (UF) e uma cidade para continuar.</h3>
            <hr>
            <div class="col-md-2">
                <select class="form-control" onchange="getCidades()" id="uf">
                    <option>Selecione uma UF</option>
                    @foreach($estados as $item)
                        <option value="{{$item->id}}">{{$item->uf}} - {{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <select class="form-control" onchange="goto()" id="cidade" style="display: none">

                </select>
            </div>
        </div>
    </div>
    <script>

        function getCidades(){
            var id = $('#uf').val();
            $.ajax({
                url: "/cep/listacidades/"+id,
                type: 'GET',
                dataType: 'html',
                success: function (result) {
                    var rs      = JSON.parse(result);
                    var list    = $('#cidade');
                    list.empty();
                    list.append('<option>Selecione uma cidade</option>');
                    rs.forEach( function( item ) {
                        var tmp = '<option value="'+item.id+'">'+item.name+'</option>';
                        list.append(tmp);
                    });
                    list.fadeIn(300);
                    list.chosen();
                }
            });
        }
        function goto(){
            $('#novo').fadeIn(300);
            $('#cidade_id').val($('#cidade').val());
        }
    </script>
    <div class="panel" id="novo" style="display: none;">
        <div class="panel-body">
            <h1>CEP</h1>
            <hr/>

        {!! Form::open(['url' => 'cep', 'class' => 'form-horizontal']) !!}

        <div class="form-group" style="display: none;">
            {!! Form::label('cidade_id', 'Cidade Id: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('cidade_id', null, ['class' => 'form-control']) !!}
            </div>
        </div><div class="form-group">
            {!! Form::label('name', 'Name: ', ['class' => 'col-sm-3 control-label ']) !!}
            <div class="col-sm-6">
                {!! Form::text('name', null, ['class' => 'form-control cep']) !!}
            </div>
        </div><div class="form-group" style="display: none;">
            {!! Form::label('active', 'Active: ', ['class' => 'col-sm-3 control-label']) !!}
            <div class="col-sm-6">
                {!! Form::text('active', 1, ['class' => 'form-control']) !!}
            </div>
        </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Salvar', ['class' => 'btn btn-primary form-control']) !!}
        </div>    
    </div>
    </div>
    </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

@endsection
