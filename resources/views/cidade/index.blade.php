@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>Cidades do estado: ({{$estado->uf}}) {{$estado->name}}</h1>
            <hr>
            <div class="table">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="30px">Edit</th>
                        <th>Ativo</th>
                    </tr>
                    </thead>
                    <tbody>
                        {{-- */$x=0;/* --}}
                        @foreach($cidades as $item)
                            {{-- */$x++;/* --}}
                            <tr>
                                <td><a href="{{ url('/cidade', $item->id) }}">{{ $item->name }}</a></td>
                                <td style="text-align: center">
                                    <a href="/cidade/{{$item->id}}/edit"><span class="fa fa-edit"></span></a>
                                </td>
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
                                            url: "/cidade/active/{{$item->id}}",
                                            type: 'GET',
                                            dataType: 'html'
                                        });
                                    });
                                </script>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        </div>
    </div>
@endsection
