@extends('layouts.master')

@section('content')

    <h1>Banner</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tr>
                <th>ID.</th><th>Name</th>
            </tr>
            <tr>
                <td>{{ $banner->id }}</td><td>{{ $banner->name }}</td>
            </tr>
        </table>
    </div>

@endsection
