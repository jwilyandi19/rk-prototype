@extends('auth.authenticated')

@section('content')
<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/lihat_kelas.js') }}"></script>
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
                        <a href="/kelas/{{$kelas->kode_kelas}}/buat-materi" class="btn btn-outline-primary">Tambah Materi</a>
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
                    @if($isEnrolling)
                    <div class="flex-fill">
                        <h1 class="text-primary text-center">Daftar Materi</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Judul</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($listMateri as $materi)
                                @component('kelas.part.materi')
                                    @slot('judul')
                                        {{$materi->judul_materi}}
                                    @endslot
                                    @slot('kodeKelas')
                                        {{$kelas->kode_kelas}}
                                    @endslot
                                    @slot('id')
                                        {{$materi->id}}
                                    @endslot
                                @endcomponent
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="flex-fill">
                        <h1 class="text-primary text-center">Daftar Tugas</h1>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($listPenugasan as $penugasan)
                                @if($isPengajar)
                                @component('kelas.part.penugasan')
                                @else
                                @component('kelas.part.tugas')
                                @endif
                                    @slot('file')
                                        {{$penugasan->file}}
                                    @endslot
                                    @slot('kodeKelas')
                                        {{$kelas->kode_kelas}}
                                    @endslot
                                    @slot('idKelas')
                                        {{$penugasan->id_kelas}}
                                    @endslot
                                    @slot('id')
                                        {{$penugasan->id}}
                                    @endslot
                                @endcomponent
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                    @if($isPengajar)
                    <a href="/kelas/{{$kelas->kode_kelas}}/penugasan" class="btn btn-primary" data-toggle="modal" data-target="#BuatTugasModal">Buat Tugas</a>
                    @endif
                    
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="BuatTugasModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Membuat Penugasan</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="/kelas/{{$kelas->kode_kelas}}/penugasan/" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label><h5>File</h5></label>
                    <br>
                    <input type="text" name="idKelas" value="{{$kelas->id}}" hidden>

                    <input type="file" name="file">
                </div>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>


<div class="modal" id="uploadTugas">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Upload Tugas</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="/kelas/{{$kelas->kode_kelas}}/tugas/" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label><h5>File</h5></label>
                    <br>
                    <input type="text" name="nrp" value="{{$user->nrp}}" hidden>
                    <input type="text" name="idTugas" id="idTugas" hidden>
                    <input type="file" name="file">
                </div>
        
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary">Upload</button>
      </div>
      </form>
    </div>
  </div>
</div>





@endsection()