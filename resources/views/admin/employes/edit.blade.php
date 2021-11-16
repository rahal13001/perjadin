@extends('layouts.admin')

@section('judul', 'Edit Data Pegawai')

@section('isi')

@php
    $foto = $employe-> foto;
@endphp

<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">
            <form class="user" method="post" action="{{ route('employes.update', $employe->id) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control form-control-user @error('nama') is-invalid @enderror" id="nama" name="nama"
                            placeholder="Masukan Nama" value="{{ $employe->nama }}">
                            @error('nama') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control form-control-user @error('nip') is-invalid @enderror" id="nip" name="nip"
                            placeholder="Masukan NIP" value="{{ $employe->nip }}">
                            @error('nip') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" class="form-control form-control-user @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan"
                            placeholder="Jabatan" value="{{ $employe->jabatan }}">
                            @error('jabatan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="pangkat">Pangkat/Golongan</label>
                        <input type="text" class="form-control form-control-user @error('pangkat') is-invalid @enderror" id="pangkat" name="pangkat"
                            placeholder="Masukan Pangkat/Golongan" value="{{ $employe->pangkat }}">
                            @error('pangkat') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="no_hp">No HP</label>
                        <input type="text" class="form-control form-control-user @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp"
                            placeholder="Masukan No HP" value="{{ $employe->no_hp }}">
                            @error('no_hp') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="email">Email</label>
                        <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror" id="email" name="email"
                            placeholder="Masukan Email" value="{{ $employe->email }}">
                            @error('email') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="status">Status Pegawai</label>
                        <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                            <option value="{{ $employe->status }}" selected>{{ $employe->status }}</option>
                            <option>1</option>
                            <option>2</option>
                          </select>
                          @error('status') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="tipe">Tipe User</label>
                        <select id="tipe" class="form-control @error('tipe') is-invalid @enderror" name="tipe">
                            <option value="{{ $employe->tipe }}" selected>{{ $employe->tipe }}</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                          </select>
                    </div> 
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="umur">Umur</label>
                        <input type="text" class="form-control form-control-user @error('umur') is-invalid @enderror" id="umur" name="umur"
                            placeholder="Masukan Umur" value="{{ $employe->umur }}">
                            @error('umur') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="foto">Foto</label>
                        <img src="{{asset('storage/'.$foto)}}" class="img-fluid !important center" alt="..." height="10px" width="200vh">
                        <input type="file" class="form-control-file form-control-user @error('foto') is-invalid @enderror" id="foto" name="foto"
                            placeholder="{{ $employe->foto }}" value="{{ $employe->foto }}">
                            @error('foto') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-4 mb-4 float-left">Ubah Data</button>
            </form>
            <a name="batal" id="batal" class="btn btn-danger" href="{{ route('employes.index') }}" role="button">Batal</a>
        </div>
    </div>
    
</div>
    
@endsection