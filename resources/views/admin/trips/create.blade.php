@extends('layouts.admin')

@section('judul', 'Tambah SPT')

@section('isi')

<div class="card shadow mb-4">
   
    <div class="col-lg-10 mx-auto">
        <div class="p-5">
            <form class="user" method="post" action="{{ route('letters.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="no_spt">Nomor SPT</label>
                        <input type="text" class="form-control form-control-user @error('no_spt') is-invalid @enderror" id="no_spt" name="no_spt"
                            placeholder="Masukan Nomor SPT" value="{{ old('no_spt') }}">
                            @error('no_spt') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="tujuan">Tujuan</label>
                        <input type="text" class="form-control form-control-user @error('tujuan') is-invalid @enderror" id="tujuan" name="tujuan"
                            placeholder="Masukan Tujuan" value="{{ old('tujuan') }}">
                            @error('tujuan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="budgets_id">Masukan Budget</label>
                        <select id="tipe" class="form-control @error('budgets_id') is-invalid @enderror" name="budgets_id">
                            @foreach ($budgets as $budget)
                            <option value="{{ $budget->id }}">{{ $budget->mata_anggaran }}</option>
                                
                            @endforeach

                          </select>                      
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="agenda">Agenda</label>
                        <input type="text" class="form-control form-control-user @error('agenda') is-invalid @enderror" id="agenda" name="agenda"
                            placeholder="Masukan Agenda" value="{{ old('agenda') }}">
                            @error('agenda') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control form-control-user @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal"
                            placeholder="Masukan No HP" value="{{ old('tanggal') }}">
                            @error('tanggal') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="durasi">Durasi</label>
                        <input type="durasi" class="form-control form-control-user @error('durasi') is-invalid @enderror" id="durasi" name="durasi"
                            placeholder="Masukan Durasi" value="{{ old('durasi') }}">
                            @error('durasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mr-4 mb-4 float-left">Tambah Data</button>
            </form>
            <a name="batal" id="batal" class="btn btn-danger" href="{{ route('letters.index') }}" role="button">Batal</a>
        </div>
    </div>
    
</div>
@endsection
@push('addon-script')


<script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'keterangan' );
</script>

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#keterangan' ) )
            .then( keterangan => {
                    console.log( keterangan );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script> --}}
    
@endpush