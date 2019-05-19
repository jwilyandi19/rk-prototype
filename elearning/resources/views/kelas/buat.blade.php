@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card p-4 mt-5" method="POST">
                {{ csrf_field() }}
                <h1 class="card-title text-center text-primary">Buat Kelas</h1>
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
                <div class="card-body p-2">
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input name="kodeKelas" type="text" class="form-control" id="kode_kelas" placeholder="Kode Kelas" required minlength="4">
                        <small id="kodeHelp" class="form-text text-muted">Silahkan masukkan Kode Kelas dari kelas yang anda ingin lihat</small>
                    </div>
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input name="namaKelas" type="text" class="form-control" id="nama_kelas" placeholder="Nama Kelas" required minlength="4">
                        <small id="namaHelp" class="form-text text-muted">Digunakan untuk menampilkan judul kelas</small>
                    </div>
                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection()