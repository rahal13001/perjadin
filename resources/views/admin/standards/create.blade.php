@extends('layouts.admin')

@section('judul', 'Tambah Anggaran')

@section('isi')

<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">
            <form class="user" method="post" action="{{ route('standards.store') }}">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="jenis_sbu">Kode Anggaran</label>
                        <input type="text" class="form-control form-control-user @error('jenis_sbu') is-invalid @enderror" id="jenis_sbu" name="jenis_sbu"
                            placeholder="Masukan Jenis SBU" value="{{ old('jenis_sbu') }}">
                            @error('jenis_sbu') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="provinsi">Masukan Provinsi</label>
                        <select id="tipe" class="form-control @error('provinsi') is-invalid @enderror" name="provinsi">
                            @foreach ($regions as $region)
                            <option value="{{ $region->provinsi }}">{{ $region->provinsi }}</option>
                                
                            @endforeach

                          </select>   
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="maksimal">Maksimal</label>
                        <input type="text" class="form-control form-control-user @error('maksimal') is-invalid @enderror" id="maksimal" name="maksimal"
                            placeholder="Masukan Nilai Maksimal" value="{{ old('maksimal') }}">
                            @error('maksimal') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-4 mb-4 float-left">Tambah Data</button>
            </form>
            <a name="batal" id="batal" class="btn btn-danger" href="{{ route('standards.index') }}" role="button">Batal</a>
        </div>
    </div>
    
</div>

@endsection