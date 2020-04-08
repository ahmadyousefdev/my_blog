@extends('layouts.default')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>{{$article->title}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            {!! $article->body !!}
        </div>
    </div>
</div>

@endsection