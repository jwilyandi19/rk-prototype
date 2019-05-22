@extends('auth.authenticated')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card p-4 mt-5" method="POST">
            <table class="table">
                            <thead>
                                <tr>
                                    <th>NRP</th>
                                    <th>Tugas</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tugas as $tugas)
                                <td><p>{{$tugas->nrp}}</p></td>
                                <td><a href="{{asset('resource/kelas').'/'.$kelas->kode_kelas.'/Tugas/'.$tugas->id.'/'.$tugas->file}}" download="{{$tugas->file}}">{{$tugas->file}}</a></td>
                            @endforeach
                            </tbody>
                        </table>

            </div>
        </div>
    </div>
</div>
@endsection()