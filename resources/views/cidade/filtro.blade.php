@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>Selecione um estado (UF) para continuar.</h1>
            <hr>
            <div class="col-md-5">
                <select class="form-control" onchange="goto()" id="uf">
                    <option>Selecione uma UF</option>
                    @foreach($estados as $item)
                        <option value="{{$item->id}}">{{$item->uf}} - {{$item->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <script>
        function goto(){
            var id = $('#uf').val();
            window.location.href = "/cidade/lista/"+id;
        }
    </script>
@endsection