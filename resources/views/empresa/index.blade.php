@extends('layouts.master')

@section('content')

<script src="{{ asset("assets/js/jquery.mousewheel-3.0.6.pack.js") }}"></script>
<link rel="stylesheet" href="{{ asset("assets/lib/fancybox/jquery.fancybox.css") }}">
<script src="{{ asset("assets/lib/fancybox/jquery.fancybox.js") }}"></script>
<script>
    function SelectElement(value, id)
    {
        $('#'+id).val(value);
    }

    function load_citys(){
        var id = $("#states").val();
        if(id > 0){
            $.ajax({
                type: "GET",
                url: "/cidade/load_citys/"+id,
                dataType : "json",
                async: false,
                success: function(result){
                    if(result.length>0){
                        $('#citys').find('option').remove();
                        $('#citys').append('<option value="0">Selecione uma cidade</option>');
                        for (var i=0; i<result.length; i++){
                            var obj = result[i];
                            var str = '<option value="'+obj.id+'">'+obj.name+'</option>';
                            $('#citys').append(str);
                        }

                    }else{
                        $('#citys').find('option').remove();
                        var str = '<option value="0">Selecione uma cidade</option>';
                        $('#citys').append(str);
                    }
                }
            });
        }
    }

</script>
<div class="panel">
    <div class="panel-body">
        <h1>Empresas <a href="{{ url('/empresa/create') }}" class="btn btn-primary pull-right">Nova Empresa</a></h1>
        <hr>
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-filter"></i> Filtro</h3>
                    <p>Utilize os parâmetros abaixo para localizar empresas</p>
                </div>
                <div class="panel-body bg-success">
                    <form action="/empresa" class="" method="get">
                        <div class="col-md-3">
                            <label for="empresa">Empresa:</label>
                            <input name="empresa" class="form-control" value="{{filter_input(INPUT_GET,'empresa')}}" placeholder="nome da empresa">
                        </div>
                        <div class="col-md-2">
                            <label for="empresa">Telefone:</label>
                            <input name="phone" class="form-control phone" value="{{filter_input(INPUT_GET,'phone')}}">
                            <?php $plano = filter_input(INPUT_GET,'plano') ?>
                            <?= ($plano) ? '<script type="text/javascript">SelectElement('.$plano.', "plano");</script>' : "" ?>
                        </div>
                        <div class="col-md-1">
                            <label for="empresa">Plano:</label>
                            <select name="plano" class="form-control" id="plano">
                                <option value="0">selecione</option>
                                <option value="4">Grátis</option>
                                <option value="6">Patrocinado</option>
                            </select>
                            <?php $plano = filter_input(INPUT_GET,'plano') ?>
                            <?= ($plano) ? '<script type="text/javascript">SelectElement('.$plano.', "plano");</script>' : "" ?>
                        </div>
                        <div class="col-md-2">
                            <label for="empresa">Categoria:</label>
                            <select name="categoria" class="form-control" id="categoria">
                                <option value="0">selecione</option>
                                @foreach($categories as $item)
                                    <option value="{{ $item->id  }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <?php $categoria = filter_input(INPUT_GET,'categoria') ?>
                            <?= ($categoria) ? '<script type="text/javascript">SelectElement('.$categoria.', "categoria");</script>' : "" ?>
                        </div>
                        <div class="col-md-1">
                            <label for="empresa">UF:</label>
                            <select name="uf" class="form-control" onchange="load_citys()" id="states">
                                <option value="0">selecione</option>
                                @foreach($ufs as $item)
                                    <option value="{{ $item->id  }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="empresa">Cidade:</label>
                            <select name="cidade" class="form-control" id="citys">
                                <option value="0">selecione uma uf</option>
                            </select>
                            <?php $uf = filter_input(INPUT_GET,'uf') ?>
                            <?php $city = filter_input(INPUT_GET,'cidade') ?>
                            <?= ($uf) ? '<script type="text/javascript">SelectElement('.$uf.', "states"); load_citys();</script>' : "" ?>
                            <?= ($city) ? '<script type="text/javascript">SelectElement('.$city.', "citys");</script>' : "" ?>
                        </div>


                        <div class="col-md-11 paddingtop15">
                            <input type="submit" class="btn btn-success form-control" value="Filtrar">
                        </div>
                        <div class="col-md-1 paddingtop15">
                            <a href="/empresa"><button type="button" class="btn btn-warning">Limpar filtro</button></a>
                        </div>

                    </form>

                </div>
            </div><!-- panel -->
        </div>
        <div class="clearfix"></div>
        <hr>
        <div class="">
            <table class="table table-responsive table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th width="20px" class="text-center">Img</th>
                    <th>Tel 1</th>
                    <th>Plano</th>
                    <th>Cidade/UF</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($empresas as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td class="text-center">{!! $item->logo ? '<a class="fancybox" rel="group" href="uploads/empresas/'.$item->logo.'"><span class="glyphicon glyphicon-picture"></span></a>' :null !!}</td>
                        <td>{{ $item->phone1 }}</td>
                        <td>{{ $item->plano['name'] }}</td>
                        <td>{{ $item->cidade['name'] }} / {{ $item->uf['uf'] }}</td>
                        <td>
                            <div style="display: none">{{ $item->active }}</div>
                            <div class="toggle-wrapper">
                                <div class="toggle toggle-light success ativo{{$item->id}}"></div>
                            </div>
                        </td> 
                        <script>
                            $('.ativo{{$item->id}}').toggles({
                                on: {{ $item->active }},
                                text: {
                                    on: 'SIM', // text for the ON position
                                    off: 'NÂO' // and off
                                },
                                height: 26
                            }).on('toggle', function (e, active) {
                                $.ajax({
                                    url: "/empresa/active/{{$item->id}}",
                                    type: 'GET',
                                    dataType: 'html'
                                });
                            });
                        </script>
                        <td>
                            <a href="{{ url('/empresa/'.$item->id.'/assets') }}"><button type="submit" class="btn btn-warning btn-xs">Imagens</button></a>
                            <a href="{{ url('/empresa/'.$item->id.'/edit') }}"><button type="submit" class="btn btn-primary btn-xs">Editar</button></a>
                            {!! Form::open(['method'=>'delete','action'=>['EmpresaController@destroy',$item->id], 'style' => 'display:inline','onsubmit' => 'return confirmDelete()']) !!}<button type="submit" class="btn btn-danger btn-xs">Deletar</button>{!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="col-md-12">
                <div class="col-md-6">
                    {!! $empresas->fragment('')->render() !!} <input>
                </div>
                <div class="col-md-6">
                    <input>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox({
            'transitionIn'	:	'elastic',
            'transitionOut'	:	'elastic',
            'speedIn'		:	600,
            'speedOut'		:	200,
            'overlayShow'	:	false
        });
    });
</script>
@endsection
