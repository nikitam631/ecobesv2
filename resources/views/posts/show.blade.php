@extends('main')

@section('title', 'Homepage')

@section('stylesheets')
  <link rel="stylesheet" href="custom.css">
@endsection

@section('content')
<div class="row">
  <div class="col-sm-8 col-sm-offset-2">
    <h1>Show your post</h1>
  </div>
</div>
<div class="row">
  <div class="col-sm-8">
    <p>Posted content : {{ $post->body }}</p>

  </div>
  <div class="col-sm-4">
    <div class="well">
      <p>Created At : {{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
      <div class="row">
        <div class="col-sm-6">
          {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary')) !!}
          {{-- <a href="#" class="btn btn-primary">Edit</a> --}}
        </div>
        <div class="col-sm-6">
          {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script src="js/scripts.js" charset="utf-8"></script>
@endsection
