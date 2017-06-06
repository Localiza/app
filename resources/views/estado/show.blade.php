@extends('layouts.master')

@section('content')

    <h1>Estado</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $estado->id }}</td><td>{{ $estado->name }}</td>
            </tr>
        </table>
    </div>

@endsection
