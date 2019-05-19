@extends('part.base')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <div class="card mt-4">
        <form class="card-body" action="/login" method="POST">
          {{ csrf_field() }}
          <h1 class="title text-center">Login</h1>
            @isset($error)
                @component("alert.danger")
                    {{$error}}
                @endcomponent
            @endisset
          <div class="form-group">
            <label for="nrp">NRP</label>
            <input name="nrp" type="text" class="form-control" id="nrp" placeholder="NRP" required minlength="14">
            <small id="emailHelp" class="form-text text-muted">Silahkan masukkan NRP yang sudah anda daftarkan</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
          </div>
          <div class="row text-center">
            <div class="col-12">
              <button type="submit" class="btn btn-primary mr-1">Masuk</button>
              <a href="/register" class="btn btn-light ml-1">Daftar</a>
            </div>
          </div>
        </form>
        </div>
    </div>
  </div>
</div>
@endsection