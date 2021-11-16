@extends('layouts.admin')

@section('judul', 'Detail Perjalanan Dinas')

@section('isi')


{{-- @php
    // $budgets = DB::table('letters')
    // -> join ('budgets', 'letter.budgets_id', '=', 'budgets.id')
    // -> select ('budgets.kode_anggaran','budgets.nama_anggaran', 'budgets.jumlah')
    // -> where ('budgets.id', '=', 'letters.budgets_id')->get();

    // $budgets = Letter::with('budgets')->get();

@endphp --}}

<div class="card shadow mb-4">
    <div class="card-group">
        <div class="card">
         <div class="row">
               <div class="col-sm-6">
                  <div class="card-body col-md-12">
                     <table class="table table-borderless table-responsive mt-n3">
                        <thead>
                              <tr>
                                 <th scope="row"> Nomor SPT </th>
                                 <td scope="col"> {{ $letter->no_spt }}</td>
                              </tr>
                              <tr>
                                 <th scope="row"> Nama Pegawai </th>
                                 <td scope="col">
                                    @foreach ($participant as $_participant)
                                    {{$_participant->nama}} <br>
                                    @endforeach
                                 </td>
                              </tr>
                              <tr>
                                 <th scope="row"> Tujuan </th>
                                 <td scope="col"> {{ $letter->tujuan }}</td>
                              </tr>
                              <tr>
                                 <th scope="row"> Kode Anggaran </th>
                                 <td scope="col" > {{ $letter->budget->kode_anggaran}} </td>
                              </tr>
                              <tr>
                                 <th scope="row"> Nama Anggaran </th>
                                 <td scope="col" > {{ $letter->budget->mata_anggaran }} </td>
                              </tr>
                              <tr>
                                 <th scope="row"> Jumlah Anggaran </th>
                                 <td scope="col" > {{ $letter->budget->jumlah }} </td>
                              </tr>
                              <tr>
                                 <th scope="row"> Agenda </th>
                                 <td scope="col"> {{ $letter->agenda }}</td>
                              </tr>
                              <tr>
                                 <th scope="row"> Tanggal </th>
                                 <td scope="col"> {{ $letter->tanggal }}</td>
                              </tr>
                              <tr>
                                 <th scope="row"> Durasi (Hari) </th>
                                 <td scope="col"> {{ $letter->durasi }}</td>
                              </tr>
                              <tr>
                                 <th scope="row"> Keterangan </th>
                                 <td scope="col"> {{ $letter->keterangan }}</td>
                              </tr>
                        </thead>
                     </table>
                     <a name="kembali" id="kembali" class="btn btn-info mr-4 float-left !important" href="{{ route('letters.index') }}" role="button">Kembali</a>
                     <a name="ubah" id="ubah" class="btn btn-warning mr-4 float-left !important" href="{{route('letters.edit',$letter->id) }}" role="button">Ubah</a>
                     <form action="{{route('letters.destroy', $letter->id)}}" method="post">
                        @method('delete')
                        @csrf
                         <button type="submit" class="btn btn-danger d-inline">Hapus</button>
                      </form> 
                  </div>
               </div>
                       


            <div class="col-md-6">
               <div class="card-body col-md-12 border border-dark">
                  <form class="user" method="post" action="{{ route('participants.update', $letter->id) }}" enctype="multipart/form-data">
                     @csrf
                     <input type="hidden" name="letter_id" value="{{ $letter->id }}">
                     <input type="hidden" name="_method" value="PUT"/>
                     <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="employes_id">Masukan Pengeluaran Ril</label>
                            <select id="tipe" class="form-control @error('standard_id') is-invalid @enderror" name="standard_id[]">
                              @foreach ($standard as $standar)
                              <option value="{{ $standar->id }}">{{ $standar->jenis_sbu}} - {{ $standar->provinsi }}</option>
                              @endforeach
                              </select>  
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0">
                           <label for="nominal">Nominal</label>
                           <input type="text" class="form-control form-control-user @error('nominal') is-invalid @enderror" id="nominal" name="nominal[]"
                               placeholder="Masukan Nominal" value="{{ old('nominal') }}">
                               @error('nominal') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                       </div>
                     </div>
                       <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                           <label for="nominal">Pilih Kuitansi Perjalan</label>
                           <input type="file" class="form-control @error('kwitansi') is-invalid @enderror" id="kwitansi" name="kwitansi[]"
                               placeholder="Masukan Kuitansi Perjalanan" value="{{ old('kwitansi') }}">
                               @error('kwitansi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                       </div>
                       </div>
                    
                       <div class="form-group row">
                        <div class="col-sm-12 mb-3 mb-sm-0">
                            <label for=""></label>
                            <button type="button" class="btn btn-primary float-right" id="pengeluaran"> + Tambah Pengeluaran</button>
                        </div>
                    </div>
                    <div class="tambah" id="tambah"></div>
                    <div class="col-sm-12 mb-3 mb-sm-0">
                     <label for="nominal">SPPD Belakang</label>
                     <input type="file" class="form-control @error('spd_belakang') is-invalid @enderror" id="spd_belakang" name="spd_belakang" value="{{ old('spd_belakang') }}">
                         @error('spd_belakang') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                   </div>
                   <div class="col-sm-12 mt-2 mb-sm-0">
                     <label for="nominal">SPPD Depan</label>
                     <input type="file" class="form-control @error('spd_depan') is-invalid @enderror" id="spd_depan" name="spd_depan" value="{{ old('spd_depan') }}">
                         @error('spd_depan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                   </div>
                   <div class="col-sm-12 mt-2 mb-sm-0">
                     <label for="nominal">Laporan Perjalanan</label>
                     <input type="file" class="form-control @error('laporan') is-invalid @enderror" id="laporan" name="laporan" value="{{ old('laporan') }}">
                         @error('laporan') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                   </div>
                   <div class="col-sm-12 mt-2 mb-sm-0">
                     <label for="nominal">Pilih Dokumentasi</label>
                     <input type="file" multiple class="form-control @error('dokumentasi') is-invalid @enderror" id="dokumentasi" name="dokumentasi[]" value="{{ old('dokumentasi') }}">
                         @error('dokumentasi') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                   </div>
                   <div class="col-sm-12 mt-2 mb-sm-0">
                   <button type="submit" class="btn btn-primary">Simpan</button>
                   </div>             
                  </form>
               </div>
            </div>
       
            


         
        </div>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script type="text/javascript">
      var no = 0;
      $('#pengeluaran').on('click', function(){
          pengeluaran()
      })

      function pengeluaran(){
         no = no+1;
         var tambah = '<div id="div'+no+'"><div class="col-sm-6 mb-3 mb-sm-0" ><label for="employes_id">Masukan Pengeluaran Ril</label><select id="tipe" class="form-control @error('standard_id') is-invalid @enderror"name="standard_id[]">@foreach ($standard as $standar)<option value="{{ $standar->id }}">{{ $standar->jenis_sbu}} - {{ $standar->provinsi }}</option>@endforeach</select></div> <div class="col-sm-6 mb-3 mb-sm-0"><label for="nominal">Nominal</label><input type="text" class="form-control form-control-user @error('nominal') is-invalid @enderror" id="nominal" name="nominal[]" placeholder="Masukan Nominal" value="{{ old('nominal') }}"> @error('nominal') <div class="invalid-feedback"> {{ $message }} </div> @enderror</div> <div class="form-group row"><div class="col-sm-12 mb-3 mb-sm-0"><label for="nominal">Pilih Kuitansi Perjalan</label><input type="file" class="form-control @error('kwitansi') is-invalid @enderror" id="kwitansi" name="kwitansi[]"placeholder="Masukan Kuitansi Perjalanan" value="{{ old('kwitansi') }}">@error('kwitansi') <div class="invalid-feedback"> {{ $message }} </div> @enderror</div><button type="button" class="remove btn btn-danger float-right mt-3" id="remove" value="'+no+'">-Hapus</button></div></div></div></div>';
         $('.tambah').append(tambah);
  
  $('.remove').on('click', function(){
   //   alert(this.value)
      $('#div'+this.value).remove();

      })
      };
          // $(this).parent().remove();
  </script>

    
@endsection