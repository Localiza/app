@extends('layouts.master')

@section('content')

    <h1>Empresa</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $empresa->id }}</td><td>{{ $empresa->name }}</td>
            </tr>
        </table>
    </div>
@endsection
