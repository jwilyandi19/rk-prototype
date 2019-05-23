@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card p-4 mt-5" method="POST">
                    {{ csrf_field() }}
                <h1 class="card-title text-center text-primary">Hapus Materi</h1>    
                <h5 class="text-center text-secondary">Apakah anda yakin ingin menghapus materi ini?</h5>            
                <div class="card-body p-2 text-center">
                    <button type="submit" class="btn btn-danger mr-1">Ya</button>
                    <a href="/kelas/{{$kelas->kode_kelas}}/materi/{{$materi->id}}" class="btn btn-outline-primary">Tidak</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection()