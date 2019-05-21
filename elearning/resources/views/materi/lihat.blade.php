@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card p-4 mt-5">
                <h1 class="card-title text-primary">{{$materi->judul_materi}}</h1>
                <p class="text-secondary">{{$materi->isi_materi}}</p>
                @if($isPengajar)
                <div class="card-body p-2">
                    <div class="flex-fill text-right">
                        <a class="btn btn-primary" href="/kelas/{{$kelas->kode_kelas}}/materi/{{$materi->id}}/ubah">Ubah</a>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection()