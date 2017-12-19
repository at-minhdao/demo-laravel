@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @if (Session::has('msg'))
            <p class="alert alert-success">{{ Session::get('msg') }}</p>
        @endif
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ route('tasks.index') }}">Tasks</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
