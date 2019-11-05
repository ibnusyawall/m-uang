@extends('layouts.master')

@section('content')

<form action="{{ url('pemasukan/'.$data->pemasukan_id) }}" method="post">
	{{ csrf_field() }}
  {{ method_field('put') }}
<div class="row">
    <div class="col-md-6">
      <div class="form-group">
      	<select class="form-control" name="sumber_pemasukan">
      		<option selected="" disabled="">Pilih Sumber Pemasukan</option>
      		@foreach($sumber as $sb)
      		<option value="{{ $sb->id }}" {{ ($data->sumber_pemasukan == $sb->id) ? 'selected' : '' }}>{{ $sb->nama }}</option>
      		@endforeach
      	</select>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <input type="number" value="{{$data->nominal}}" placeholder="Nominal" name="nominal" class="form-control" />
      </div>
    </div>
  </div>
 
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" value="{{ date('m/d/Y', strtotime($data->tanggal)) }}"placeholder="Pilih tanggal" name="tanggal" class="form-control datepicker" autocomplete="off" />
      </div>
    </div>
    <div class="col-md-6">
    	<textarea class="form-control" rows="10" name="keterangan" placeholder="masukan keterangan">{{$data->keterangan}}</textarea>
    </div>

  </div>
  
    <div class="row">
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
	})
</script>
@endsection