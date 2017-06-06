@extends('layouts.master')

@section('content')

    <h1>Cidade</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $cidade->id }}</td><td>{{ $cidade->name }}</td>
            </tr>
        </table>
    </div>

@endsection
