@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card p-4 mt-5" method="POST">
                    {{ csrf_field() }}
                <h1 class="card-title text-center text-primary">Lihat Kelas</h1>
                @isset($error)
                    @component("alert.danger")
                        {{$error}}
                    @endcomponent
                @endisset
                <div class="card-body p-2">
                    <div class="form-group">
                        <label for="kode_kelas">Kode Kelas</label>
                        <input name="kodeKelas" type="text" class="form-control" id="kode_kelas" placeholder="Kode Kelas" required minlength="4">
                        <small id="Help" class="form-text text-muted">Silahkan masukkan Kode Kelas dari kelas yang anda ingin lihat</small>
                    </div>
                    <button type="submit" class="btn btn-primary mr-1">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-12">
            <div class="card p-4 mt-5">
                <h1 class="card-title text-center text-primary">Kelas Diikuti</h1>
                <div class="card-body p-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($kelasList as $kelas)
                        @component('kelas.part.kelas')
                            @slot('id')
                                {{$kelas->id}}
                            @endslot
                            @slot('kode')
                                {{$kelas->kode_kelas}}
                            @endslot
                            @slot('nama')
                                {{$kelas->nama_kelas}}
                            @endslot
                        @endcomponent
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection()