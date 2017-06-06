@extends('layouts.master')

@section('content')

    <h1>Bairro</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Nome</th>
            </tr>
            <tr>
                <td>{{ $bairro->id }}</td><td>{{ $bairro->name }}</td>
            </tr>
        </table>
    </div>

@endsection
