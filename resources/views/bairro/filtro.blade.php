@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>Bairro</h1>
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
                url: "/bairro/listacidades/"+id,
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
            var id = $('#cidade').val();
            window.location.href = "/bairro/lista/"+id;
        }
    </script>
@endsection