@extends('main')

@section('title', 'Homepage')

@section('content')
<div class="row">
  <div class="col-sm-8">
    <h1>All posts</h1>
  </div>
  <div class="col-sm-4">
    <div class="well">
      <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    </div>
  </div>
</div>
<hr>
@foreach ($posts as $post)
  <div class="row">
    <div class="col-sm-8">
      <p>Post Id : {{ $post->id }}</p>
      <p>Posted content : {{ substr($post->body, 0, 50) }} {{ strlen($post->body) >50 ? "..." : "" }}</p>

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
            {!! Html::linkRoute('posts.show', 'View', array($post->id), array('class' => 'btn btn-default')) !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
@endforeach

@endsection

@section('scripts')
  <script src="js/scripts.js" charset="utf-8"></script>
@endsection
