@extends('layouts.master')

@section('content')

<form action="{{ url('pengeluaran/'.$data->pengeluaran_id) }}" method="post">
	{{ csrf_field() }}
  {{ method_field('put') }}
  <div class="row">
    
    <div class="col-md-6">
      <div class="form-group">
        <input type="number" value="{{ $data->nominal }}" name="nominal" class="form-control" />
      </div>
    </div>
     <div class="col-md-6">
      <div class="form-group">
        <input type="text" value="{{ date('m/d/Y', strtotime($data->tanggal)) }}" name="tanggal" class="form-control datepicker" autocomplete="off" />
      </div>
    </div>
  </div>
  
  <div class='row'>
    <div class="col-md-12">
    	<textarea class="form-control" rows="5" name="keterangan" placeholder="">{{ $data->keterangan }}</textarea>
    </div>
  </div>

  	<br><div class="row">
    <div class="col-lg-8">
      <input type='submit' class="btn btn-outline-info" value="Simpan">
      <a type='submit' href='{{ url("pengeluaran") }}' class="btn btn-outline-info"> Kembali </a>
    </div>
    </div>
 
</form>
@endsection

@section('script')

<script type="text/javascript">

	$(document).ready(function(){
		$('.datepicker').datepicker();
	})

</script>
@endsection