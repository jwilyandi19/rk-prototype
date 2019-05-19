@extends('part.base')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 offset-md-4">
      <div class="card mt-4">
        <form class="card-body" action="/register" method="POST">
            {{ csrf_field() }}
            <h1 class="title text-center">Daftar</h1>
            @isset($success)
                @component("alert.success")
                    {{$success}}
                @endcomponent
            @endisset
            @isset($error)
                @component("alert.danger")
                    {{$error}}
                @endcomponent
            @endisset
          <div class="form-group">
            <label for="nrp">NRP</label>
            <input name="nrp" type="text" class="form-control" id="nrp" placeholder="NRP 14 Digit" required minlength="14">
            <small id="emailHelp" class="form-text text-muted">Silahkan masukkan NRP yang akan anda daftarkan</small>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
          </div>
          <div class="row text-center">
            <div class="col-12">
              <button type="submit" class="btn btn-primary mr-1">Daftar</button>
              <a href="/login" class="btn btn-light ml-1">Masuk</a>
            </div>
          </div>
        </form>
        </div>
    </div>
  </div>
</div>
@endsection