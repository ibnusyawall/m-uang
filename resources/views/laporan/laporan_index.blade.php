@extends('layouts.master')

@section('content')

<form action="{{ url('cari-laporan/') }}" method="get">
  {{ csrf_field() }}
  <div class="row">
    
    <div class="col-md-6">
      <div class="form-group">
        <input type="text" placeholder="tanggal dari" name="dari" class="form-control datepicker" autocomplete="off" />
      </div>
    </div>

    <div class="col-md-6">
      <div class="form-group">
        <input type="text" placeholder="tanggal sampai" name="sampai" class="form-control datepicker" autocomplete="off" />
      </div>
    </div>

  </div>
  
  	<div class="col-lg-8">
  		<input type='submit' class="btn btn-outline-info" value="cari">
  	</div>
 
</form>

@if(isset($pemasukan))
<br><div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0"> Data Pemasukan </h3>
            </div>
             <a href="{{ url('export-pemasukan/'.$dari.'/'.$sampai) }}" class="btn btn-success"> Export to Excel </a>
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Sumber</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($pemasukan as $index=>$p)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ date('d M Y ', strtotime($p->tanggal)) }}</td>
                    <td>Rp. {{ number_format( $p->nominal, 0) }}</td>
                    <td>{{ $p->nama }}</td>
                  </tr>
                @endforeach
                <tr>
                	<td></td>
                	<td>Total Pemasukan : </td>
                	<td>Rp. <b>{{ number_format($t_pemasukan, 0) }}</b></td>
                </tr>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
@endif

@if(isset($pengeluaran))
<br><div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0"> Data Pengeluaran </h3>
            </div>
            <a href="" class="btn btn-info"> Export to Excel </a>
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                @foreach($pengeluaran as $index=>$p)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ date('d M Y ', strtotime($p->tanggal)) }}</td>
                    <td>Rp. {{ number_format( $p->nominal, 0) }}</td>
                    <td>{{ $p->keterangan }}</td>
                  </tr>
                @endforeach
                <tr>
                	<td></td>
                	<td>Total Pengeluaran : </td>
                	<td>Rp. <b>{{ number_format($t_pengeluaran, 0) }}</b></td>
                </tr>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
@endif

@endsection

@section('script')

<script type="text/javascript">

	$(document).ready(function(){
		$('.datepicker').datepicker();
	})

</script>
@endsection