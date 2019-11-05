@extends('layouts.master')

@section('content')

<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Manage pemasukan </h3>
            </div>
            <a  href="{{ url('pemasukan/tambah') }}" class="btn btn-outline-info">Tambah Pemasukan</a><hr>
            <div class="table-responsive">

              <table id="data_p" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Sumber</th>
                    <th scope="col">Nominal</th>
                    <th scope="col">Tanggal</th>
                    <center>
                      <th scope="col">Action</th>
                    </center>
                  </tr>
                </thead>
                <tbody>
                @foreach($data as $index=>$sb)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $sb->nama }}</td>
                    <td>{{ $sb->nominal }}</td>
                    <td>{{ date('d M Y ', strtotime($sb->tanggal)) }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <div class="card-footer py-4">
              <nav aria-label="...">
                <ul class="pagination justify-content-end mb-0">
                  <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                      <i class="fas fa-angle-left"></i>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="page-item active">
                    <a class="page-link" href="#">1</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                  </li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item">
                    <a class="page-link" href="#">
                      <i class="fas fa-angle-right"></i>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
            
          </div>
        </div>
      </div>


<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-success modal-dialog-centered modal-" role="document">
    <div class="modal-content bg-gradient-success">
      <div class="modal-header">
        <h6 class="modal-title" id="modal-title-notification">Your attention is required</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="py-3 text-center">
          <i class="ni ni-bell-55 ni-3x"></i>
          <h4 class="heading mt-4">Hapus Data Sumber</h4>
          <p>Apakah Anda Yakin Ingin Menghapus Data Ini ? </p>
        </div>
      </div>
      <div class="modal-footer">
        <form action="" method="post">
          {{ csrf_field() }}
          {{ method_field('delete') }}
          <button type="submit" class="btn btn-white">Hapus</button>
        </form>
        <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@endsection

@section('script')

<script type="text/javascript">

  $(document).ready(function(){
    $('#data_p').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ url('pemasukan/yajra') }}",
        columns: [
            // or just disable search since it's not really searchable. just add searchable:false
            {data: 'rownum', name: 'rownum'},
            {data: 'nama', name: 'nama'},
            {data: 'nominal', name: 'nominal'},
            {data: 'tanggal', name: 'tanggal'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
    
    $('body').on('click', '.btn-hapus', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      $('#modal-notification').find('form').attr('action', url);
      $('#modal-notification').modal()
    })
  })

</script>

@endsection