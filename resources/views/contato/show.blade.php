@extends('layouts.master')

@section('content')

    <h1>Contato</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $contato->id }}</td><td>{{ $contato->name }}</td>
            </tr>
        </table>
    </div>

@endsection
