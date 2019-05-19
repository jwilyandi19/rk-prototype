@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card p-4 mt-5" method="POST">
                <h1 class="card-title text-center text-primary">{{$kelas->kode_kelas}}</h1>
                <h2 class="card-subtitle text-center text-secondary">{{$kelas->nama_kelas}}</h2>
                <div class="card-body p-2">
                    <div class="flex-fill text-right">
                        @unless($isPengajar)
                            @if($isEnrolling)
                            <a href="/kelas/{{$kelas->kode_kelas}}/expell" class="btn btn-danger">Keluar Kelas</a>
                            @else
                            <a href="/kelas/{{$kelas->kode_kelas}}/enroll" class="btn btn-primary">Ikuti Kelas</a>
                            @endif
                        @endunless
                        @if($isPengajar)
                        <a href="/kelas/{{$kelas->kode_kelas}}/ubah" class="btn btn-outline-primary">Ubah Kelas</a>
                        <a href="/kelas/{{$kelas->kode_kelas}}/hapus" class="btn btn-danger">Hapus Kelas</a>
                        @endif
                    </div>
                    @if($isPengajar)
                    <div class="flex-fill">
                        <h1 class="text-primary text-center">Daftar Pengguna</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NRP</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($listPengguna as $pengguna)
                                @component('kelas.part.user')
                                    @slot('nrp')
                                        {{$pengguna->nrp}}
                                    @endslot
                                    @slot('id')
                                        {{$pengguna->id}}
                                    @endslot
                                @endcomponent
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection()