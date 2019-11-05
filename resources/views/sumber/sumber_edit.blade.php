@extends('layouts.master')

@section('content')

<form action="{{ url('sumber-pemasukan/'.$data->id) }}" method="post">
	{{ csrf_field() }}
  {{ method_field('put') }}
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input name='nama' type="text" class="form-control" value="{{ $data->nama }}">
      </div>
    </div>
    <div class="form-group">
  		<input type="submit" value='Edit Sumber' class="btn btn-info">
  	</div>
  </div>
</form>

@endsection