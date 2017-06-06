@extends('layouts.master')

@section('content')

    <h1>Plano</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $plano->id }}</td><td>{{ $plano->name }}</td>
            </tr>
        </table>
    </div>

@endsection
