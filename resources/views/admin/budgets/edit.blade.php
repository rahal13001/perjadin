@extends('layouts.admin')

@section('judul', 'Edit Data Pegawai')

@section('isi')


<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">
            <form class="user" method="post" action="{{ route('budgets.update', $budget->id) }}">
                @method('put')
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="kode_anggaran">Kode Anggaran</label>
                        <input type="text" class="form-control form-control-user @error('kode_anggaran') is-invalid @enderror" id="kode_anggaran" name="kode_anggaran"
                            placeholder="Masukan Kode Anggaran" value="{{ $budget->kode_anggaran }}">
                            @error('kode_anggaran') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="mata_anggaran">Mata Anggaran</label>
                        <input type="text" class="form-control form-control-user @error('mata_anggaran') is-invalid @enderror" id="mata_anggaran" name="mata_anggaran"
                            placeholder="Masukan Mata Anggaran" value="{{ $budget->mata_anggaran }}">
                            @error('mata_anggaran') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="jumlah">Jumlah</label>
                        <input type="text" class="form-control form-control-user @error('jumlah') is-invalid @enderror" id="jumlah" name="jumlah"
                            placeholder="Jumlah" value="{{ $budget->jumlah }}">
                            @error('jumlah') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="dokumen">Dokumen</label>
                        <input type="text" class="form-control form-control-user @error('dokumen') is-invalid @enderror" id="dokumen" name="dokumen"
                            placeholder="Masukan Dokumen" value="{{ $budget->dokumen }}">
                            @error('dokumen') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary mr-4 mb-4 float-left">Ubah Data</button>
            </form>
            <a name="batal" id="batal" class="btn btn-danger" href="{{ route('budgets.index') }}" role="button">Batal</a>
        </div>
    </div>
    
</div>
    
@endsection