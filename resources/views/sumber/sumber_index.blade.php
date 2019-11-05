@extends('layouts.master')

@section('content')

<div class="row">
        <div class="col">
          <div class="card shadow">
            <div class="card-header border-0">
              <h3 class="mb-0">Manage sumber pemasukan </h3>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Created At</th>
                    <th scope="col">
                      <center>Action</center>
                    </th>
                  </tr>
                </thead>
                <tbody>
                @foreach($sumber as $index=>$sb)
                  <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $sb->nama }}</td>
                    <td>{{ $sb->created_at }}</td>
                    <td>
                      <center>
                          <div>

                            <a href="{{ url('sumber-pemasukan/'.$sb->id) }}">
                              <i class="ni ni-ruler-pencil text-green"></i>
                                <span>Edit</span>
                            </a>
                              
                             
                            <a sumber-id="{{ $sb->id }}" class="btn-hapus" href="{{ url('sumber-pemasukan/'.$sb->id) }}">
                              <i class="ni ni-fat-remove text-danger"></i>
                                <span>Hapus</span>
                            </a>
                              
                          </div>
                        </a>
                      </center>
                    </td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <a href="{{ url('sumber-pemasukan/add') }}" class='btn btn-outline-info'> Tambah Sumber </a>
          </div>
        </div>
      </div>

<div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-info modal-dialog-centered modal-" role="document">
                      <div class="modal-content bg-gradient-info">
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
    $('.btn-hapus').click(function(e){
      e.preventDefault();
      const id  = $(this).attr('sumber-id')
      const url = "{{ url('sumber-pemasukan') }}"+'/'+id
      $('#modal-notification').find('form').attr('action', url)
      $('#modal-notification').modal()
    });
  });
  
</script>
@endsection