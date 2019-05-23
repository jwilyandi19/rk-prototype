@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card p-4 mt-5" method="POST">
                {{ csrf_field() }}
                <h1 class="card-title text-center text-primary">Tambah Materi</h1>
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
                        <label for="judul_materi">Judul Materi</label>
                        <input name="judulMateri" type="text" class="form-control" id="judul_materi" placeholder="Judul Materi" required minlength="4">
                        <small id="judulHelp" class="form-text text-muted">Silahkan masukkan judul materi yang anda ingin buat</small>
                    </div>
                    <div class="form-group">
                        <label for="isi_materi">Isi Materi</label>
                        <textarea name="isiMateri" class="form-control" id="isi_materi" placeholder="Isi materimu di sini" required minlength="4"></textarea> 
                        <small id="isiHelp" class="form-text text-muted">Silahkan masukkan isi materi yang anda ingin buat</small>
                    </div>
                    <button type="submit" class="btn btn-primary mr-1">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection()