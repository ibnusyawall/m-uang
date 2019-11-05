@extends('layouts.master')

@section('content')


<div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Views</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count_v }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i></span>
                    <span class="text-nowrap">Since last Years</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Sumber Pemasukan</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count_s }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-chart-pie"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Pemasukan</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count_p }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Pengeluaran</h5>
                      <span class="h2 font-weight-bold mb-0">{{ $count_k }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-percent"></i>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>

<br>

<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Total Pemasukan dan Pengeluaran</h3>
            </div>
            
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Total Uang Pemasukan</th>
                    <th scope="col">Total Uang Pengeluaran</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Rp. <b>{{ number_format($tu_pemasukan, 0) }}</b></td>
                    <td>Rp. <b>{{ number_format($tu_pengeluaran, 0) }}</b></td>
                  </tr>
                	
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>


<div class="nav-wrapper">
    <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
        <li class="nav-item">
            <a data-placement="top" title="Lihat data sumber pemasukan" class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-cloud-upload-96 mr-2"></i>Data Sumber</a>
        </li>
        <li class="nav-item">
            <a data-placement="top" title="Lihat data pemasukan" class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-bell-55 mr-2"></i>Data Pemasukan</a>
        </li>
        <li class="nav-item">
            <a data-placement="top" title="Lihat data pengeluaran" class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-calendar-grid-58 mr-2"></i>Data Pengeluaran</a>
        </li>
    </ul>
</div>
<div class="card shadow">
    <div class="card-body">
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">

               <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Data Sumber Pemasukan</h3>
            </div>
            
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                  	<th scope="col">#</th>
                    <th scope="col">Nama Sumber</th>
                    <th scope="col">Created At</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($d_sumber as $index=>$s)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ date('d M Y', strtotime($s->created_at)) }}</td>
                  </tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>

            </div>

            <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                
            	<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Data Pemasukan</h3>
            </div>
            
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                  	<th scope="col">#</th>
                    <th scope="col">Sumber</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($d_pemasukan as $index=>$s)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>Rp. {{ number_format($s->nominal, 0) }}</td>
                    <td>{{ date('d M Y ', strtotime($s->tanggal)) }}</td>
                  </tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
            </div>

            <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                <div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Data Pengeluaran</h3>
            </div>
            
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                  	<th scope="col">#</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                	@foreach($d_pengeluaran as $index=>$s)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>Rp. {{ number_format( $s->nominal, 0) }}</td>
                    <td>{{ date('d M Y ', strtotime($s->tanggal)) }}</td>
                    <td>{{ $s->keterangan }}</td>
                  </tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
            </div>
            </div>


        </div>
    </div>
</div>

@endsection