@extends('layouts.master')

@section('content')

    <h1>CEP</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>CEP</th>
            </tr>
            <tr>
                <td>{{ $cep->id }}</td><td>{{ $cep->name }}</td>
            </tr>
        </table>
    </div>

@endsection
