@extends('main')

@section('title', 'Homepage')

@section('stylesheets')
  <link rel="stylesheet" href="custom.css">
@endsection

@section('content')
<div id="app">
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      <h1>Create your post</h1>
      <post-component></post-component>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-8 col-sm-offset-2">
      {!! Form::open(['route' => 'posts.store', 'files'=>true]) !!}
        {{ Form::label('body', 'Post Body:') }}
        {{ Form::textarea('body', null, array('class' => 'form-control')) }}
        <br>
        {{ Form::label('featured_image', 'Upload Featured Image:') }}
        {{ Form::file('featured_image') }}
        <br>
        {{ Form::submit('Create Post', array('class' => 'btn btn-primary')) }}
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script src="../js/app.js" charset="utf-8"></script>
@endsection
