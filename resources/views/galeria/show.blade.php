@extends('layouts.master')

@section('content')

    <h1>Galerium</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $galerium->id }}</td><td>{{ $galerium->name }}</td>
            </tr>
        </table>
    </div>

@endsection
