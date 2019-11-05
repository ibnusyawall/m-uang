@extends('layouts.master')

@section('content')

<form action="{{ url('sumber-pemasukan/add') }}" method="post">
	{{ csrf_field() }}
  <div class="row">
    <div class="col-md-6">
      <div class="form-group">
        <input name='nama' type="text" class="form-control" placeholder="Nama sumber">
      </div>
    </div>
    <div class="form-group">
  		<input type="submit" value='Tambah sumber' class="btn btn-info">
  	</div>
  </div>
</form>

@endsection