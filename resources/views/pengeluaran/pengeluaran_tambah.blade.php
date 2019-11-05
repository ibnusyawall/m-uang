@extends('layouts.master')

@section('content')

<form action="{{ url('pengeluaran/tambah') }}" method="post">
	{{ csrf_field() }}
  <div class="row">
    
    <div class="col-md-6">
      <div class="form-group">
        <input type="number" placeholder="Nominal" name="nominal" class="form-control" />
      </div>
    </div>
     <div class="col-md-6">
      <div class="form-group">
        <input type="text" placeholder="Pilih tanggal" name="tanggal" class="form-control datepicker" autocomplete="off" />
      </div>
    </div>
  </div>
  
  <div class='row'>
    <div class="col-md-12">
    	<textarea class="form-control" rows="5" name="keterangan" placeholder="masukan keterangan"></textarea>
    </div>
  </div>

  	<br><div class="row">
    <div class="col-lg-8">
      <input type='submit' class="btn btn-outline-info" value="Simpan">
      <a type='submit' href='{{ url("pemasukan") }}' class="btn btn-outline-info"> Kembali </a>
    </div>
    </div>
 
</form>
@endsection

@section('script')
<script type="text/javascript">

	$(document).ready(function(){
		$('.datepicker').datepicker();
	});
  
</script>
@endsection