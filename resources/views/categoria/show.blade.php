@extends('layouts.master')

@section('content')
    <div class="panel">
        <div class="panel-body">
            <h1>Categoria</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tr>
                        <th>Cod</th><th>Nome</th>
                    </tr>
                    <tr>
                        <td>{{ $categorium->id }}</td><td>{{ $categorium->name }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

@endsection
