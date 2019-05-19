@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form class="card p-4 mt-5" method="POST">
                    {{ csrf_field() }}
                <h1 class="card-title text-center text-primary">Hapus Kelas</h1>    
                <h5 class="text-center text-secondary">Apakah anda yakin ingin menghapus kelas {{$kelas->kode_kelas}}?</h5>            
                <div class="card-body p-2 text-center">
                    <button type="submit" class="btn btn-danger mr-1">Hapus</button>
                    <a href="/kelas/{{$kelas->kode_kelas}}" class="btn btn-outline-primary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection()