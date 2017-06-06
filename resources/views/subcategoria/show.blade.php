@extends('layouts.master')

@section('content')

    <h1>Sub-categoria</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $subcategorium->id }}</td><td>{{ $subcategorium->nome }}</td>
            </tr>
        </table>
    </div>

@endsection
