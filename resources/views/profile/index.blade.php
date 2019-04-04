@extends('main')

@section('title', 'Profile')

@section('content')

<div class="main-section" id="app">
  <div class="row">
    <div class="col-sm-3 dp-section mypost-section">
      @if (Auth::check())
          <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle img-responsive dp"/>
          <h1 class="username-n name "><a href="{{ url('/profile') }}/{{Auth::user()->slug}}">{{Auth::user()->name}}</a> </h1>

      @endif

      @if (Auth::guest())
        <!-- DP SECTION -->
        <div class="dp-section">
          <a href="{{ route('login') }}"><h1>LOGIN</h1></a>
          <a href="{{ route('register') }}"><p>NEW USER</p></a>

          <br>

        </div>
        <!-- DP SECTION -->


      @endif

      <div class="edit-links-n">
        <a href="{{ url('editProfile') }}" class="text-right">Edit</a>
        <ul>
          <li class="city">City -
          </li>
          <li class="country">Country -
          </li>
          <li class="about">About -</li>
        </ul>
      </div>
    </div>
    <!-- POST SECTION START -->
    <div class="col-sm-6 status-part text-center profile-page">
      <myprofile-component

      ></myprofile-component>

    </div>
    <!-- POST SECTION END -->
  </div>
</div>

@endsection

@section('scripts')
  <script src="../js/app.js" charset="utf-8"></script>
@endsection
