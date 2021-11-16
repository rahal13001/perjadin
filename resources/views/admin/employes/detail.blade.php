@extends('layouts.admin')

@section('judul', 'Detail Pegawai')

@section('isi')

@php
    $foto = $employe -> foto;
@endphp

<div class="card shadow mb-4">
    <div class="card-group">
        <div class="card col-md-2">
          <img src="{{asset('storage/'.$foto)}}" class="img-fluid !important center" alt="..." height="10px" width="200vh">
        </div>

        <div class="card">
            <div class="card-body col-md-8">

                <table class="table table-borderless table-responsive mt-n3">
                    <thead>
                        <tr>
                           <th scope="row"> Nama </th>
                           <td scope="col"> {{ $employe->nama }}</td>
                        </tr>
                        <tr>
                           <th scope="row"> NIP </th>
                           <td scope="col"> {{ $employe->nip }}</td>
                        </tr>
                        <tr>
                           <th scope="row"> Jabatan </th>
                           <td scope="col"> {{ $employe->jabatan }}</td>
                        </tr>
                        <tr>
                           <th scope="row"> Pangkat/Golongan </th>
                           <td scope="col"> {{ $employe->pangkat }}</td>
                        </tr>
                        <tr>
                           <th scope="row"> Umur </th>
                           <td scope="col"> {{ $employe->umur }}</td>
                        </tr>
                        <tr>
                           <th scope="row"> Email </th>
                           <td scope="col"> {{ $employe->email }}</td>
                        </tr>
                        <tr>
                           <th scope="row"> No HP </th>
                           <td scope="col"> {{ $employe->no_hp }}</td>
                        </tr>
                        <tr>
                            <th scope="row"> Tipe User </th>
                            <td scope="col"> {{ $employe->tipe }}</td>
                         </tr>
                    </thead>
                </table>
                <a name="kembali" id="kembali" class="btn btn-info mr-4 float-left !important" href="{{ route('employes.index') }}" role="button">Kembali</a>
                <a name="ubah" id="ubah" class="btn btn-warning mr-4 float-left !important" href="{{route('employes.edit',$employe->id) }}" role="button">Ubah</a>
                <form action="{{route('employes.destroy', $employe->id)}}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="btn btn-danger d-inline">Hapus</button>
                </form> 
            </div>

        </div>

    </div>
</div>
    
@endsection