@extends('main')

@section('title', 'Homepage')

@section('stylesheets')
  <link rel="stylesheet" href="custom.css">
@endsection

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <h1>Edit your post</h1>
  </div>
</div>
<div class="row">
  {{-- form model is used that this form already has data --}}
  {{-- here $post is a model object which we are binding our form to  --}}
  {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method'=>'PUT' ]) !!}
  <div class="col-sm-8">

      {{ Form::label('body', 'Post Body:') }}
      {{ Form::textarea('body', null, array('class' => 'form-control')) }}
      <br>

  </div>
  <div class="col-sm-4">
    <div class="well">
      <p>Created At : {{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
      <div class="row">
        <div class="col-sm-6">
          {{ Form::submit('Save', array('class' => 'btn btn-success')) }}

          {{-- <a href="#" class="btn btn-primary">Edit</a> --}}
        </div>
        <div class="col-sm-6">

          {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger')) !!}
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>
@endsection

@section('scripts')
  <script src="js/scripts.js" charset="utf-8"></script>
@endsection
