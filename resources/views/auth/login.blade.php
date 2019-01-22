@extends('_layouts.basic')

@section('tubuh')
  <div class="container">
    <div class="row">
      @if (count($errors) > 0)
        <div class="alert alert-danger alert-icon-left alert-dismissible fade in mb-2" role="alert">
          <strong>Maaf!</strong><br>
          @foreach ($errors->all() as $error)
            {{ $error }}<br>
          @endforeach
        </div>
      @endif
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4 batas-atas">
          <div class="account-wall">
            <h2 align="center">Sign In</h2>
            <form class="form-signin" action="{{route('login')}}" method="post">
              {{ csrf_field() }}
              <input type="text" name="name" class="form-control" placeholder="Nama" required autofocus>
              <input type="password" name="password" class="form-control" placeholder="Password" required>
              <button class="btn btn-lg btn-primary btn-block" type="submit">
                  Login
              </button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
