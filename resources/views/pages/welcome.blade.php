@extends('main')

@section('title', 'Homepage')

@section('content')

<div class="main-section" id="app">

  <div class="row">
    <div class="col-sm-3 dp-section">
      @if (Auth::check())
          <img src="{{url('../')}}/public/img/{{Auth::user()->pic}}" width="30px" height="30px" class="img-circle img-responsive dp"/>
          <h1 class="username-n name "><a href="{{ url('/profile') }}/{{Auth::user()->slug}}">{{Auth::user()->name}}</a> </h1>

          <ul class="nav nav-tabs">
            <li ><a type="button" name="button" class="btn trending-btn" data-toggle="tab" href="#trend"> <img src="{{asset('img/icons/side-tab-arrow/trending.png')}}" alt="Ecobes" class="img-responsive"><span>Trending</span> </a>
            <br>
            </li>
            <li class="active"><a type="button" name="button" class="btn updates-btn" data-toggle="tab" href="#recents"> <img src="{{asset('img/icons/side-tab-arrow/update.png')}}" alt="Ecobes" class="img-responsive"><span class="allspan-n">All Updates</span> </a></li>
          </ul>

      @endif

      @if (Auth::guest())
        <!-- DP SECTION -->
        <div class="dp-section">
          <a href="{{ route('login') }}"><h1>LOGIN</h1></a>
          <a href="{{ route('register') }}"><p>NEW USER</p></a>

          <br>
          <ul class="nav nav-tabs">
            <li><a type="button" name="button" class="btn trending-btn" data-toggle="tab" href="#trend"> <img src="{{asset('img/icons/side-tab-arrow/trending.png')}}" alt="Ecobes" class="img-responsive"><span>Trending</span> </a>
            <br>
            </li>
            <li class="active"><a type="button" name="button" class="btn updates-btn" data-toggle="tab" href="#recents"> <img src="{{asset('img/icons/side-tab-arrow/update.png')}}" alt="Ecobes" class="img-responsive"><span class="allspan-n">All Updates</span> </a></li>
          </ul>


        </div>
        <!-- DP SECTION -->


      @endif
    </div>
    <div class="col-sm-6">
      <post-component

      ></post-component>

    </div>
    <div class="col-sm-2">

    </div>
  </div>
</div>
@endsection

@section('scripts')
  <script src="../js/app.js" charset="utf-8"></script>
@endsection
