@extends('main')

@section('title', 'Homepage')

@section('content')
<div class="row">
  <div class="col-sm-12">
    <h1>Hello, world!</h1>
  </div>
</div>
<hr>
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
<hr>
<div class="row" id="app">
  <div class="col-sm-8">
    <post-component
      v-for="post in blog"
      :key="post.index"
      :id="post.id"
      :name="post.user.name"
      :body="post.body"
      :created_at="post.created_at"
      :image="post.image"
      :post_id="post.id"
      login="{{ Auth::check() }}"
      :likes="post.likes.length"
    ></post-component>
    <hr>
  </div>
  <div class="col-sm-4">
    <h1>sidebar</h1>
  </div>
</div>
@endsection

@section('scripts')
  <script src="../js/app.js" charset="utf-8"></script>
@endsection
