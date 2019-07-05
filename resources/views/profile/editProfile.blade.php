@extends('main')

@section('title', 'Edit Profile')

@section('content')

<div class="container-fluid edit-profile-page">
    <div class="row justify-content-center">
      <div class="col-sm-2 no-pad">
        <div class="left-sidebar-n">
          <ul class="nav nav-pills nav-stacked service-nav">

            <li class="active"><a data-toggle="tab" href="#general">General Settings</a></li>
            <li><a data-toggle="tab" href="#dp">Change DP</a></li>
            <li><a data-toggle="tab" href="#password">Change Password</a></li>

          </ul>
        </div>
      </div>
      <div class="col-sm-5 col-sm-offset-2 edit-page-form-sec">
        <div class="tab-content">
          <div id="general" class="tab-pane fade in active">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-sm-12">
              <form class="" action="{{url('/updateProfile')}}" method="post">
                <div class="row">
                  <div class="form-group">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                  </div>
                </div>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="">City Name</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="city" value="" />
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="">Country</label>
                    </div>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="country" value="">
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-4">
                      <label for="">About Me</label>
                    </div>
                    <div class="col-md-8">
                      <textarea name="about" class="form-control" rows="3" cols="30"></textarea>
                    </div>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                      <input type="submit" class="btn btn-green" value="Update">
                    </div>

                  </div>
                </div>

              </form>
            </div>
          </div>
          <div id="dp" class="tab-pane fade">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <img src="{{asset('public/img/' . Auth::user()->pic)}}" alt="" width="80px" height="80px" class="img-responsive">
            <br>

            <form action="{{url('/')}}/uploadPhoto" method="post" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
              <input type="file" name="pic" class="form-control pic-up">
              <input type="submit" name="btn" class="btn btn-green" value="Update">
            </form>
          </div>
          <div id="password" class="tab-pane fade">
            <div class="card-body">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form class="form-horizontal" method="POST" action="{{url('/')}}/uploadPassword">
                    {{ csrf_field() }}

                    {{-- <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-3 control-label">Current Password</label>

                        <div class="col-md-8">
                            <input id="current-password" type="password" class="form-control" name="current-password" required>

                            @if ($errors->has('current-password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('current-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div> --}}

                    <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                        <label for="new-password" class="col-md-3 control-label">New Password</label>

                        <div class="col-md-8">
                            <input id="new-password" type="password" class="form-control" name="new-password" required minlength="6" maxlength="10">

                            @if ($errors->has('new-password'))
                                <span class="help-block">
                                <strong>{{ $errors->first('new-password') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    {{-- <div class="form-group">
                        <label for="new-password-confirm" class="col-md-3 control-label">Confirm New Password</label>

                        <div class="col-md-8">
                            <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                        </div>
                    </div> --}}

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-green">
                                Change Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>
        <!-- <div class="row">
          <div class="col-sm-12">
            <h2 class="text-center text-capitalize">{{Auth::user()->name}}</h2>
          </div>
        </div> -->


    </div>
</div>
@endsection
