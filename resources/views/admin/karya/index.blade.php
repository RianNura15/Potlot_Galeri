@extends('layouts.admin.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <p class="h5">Data Karya</p>
                  <hr>
                    <table class="table" width="100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Nama</th>
                          <th>Gambar</th>
                          <th>Keterangan</th>
                          <th>Pemasar</th>
                          <th></th>
                        </tr>
                      </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
  <script type="text/javascript">
  const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
    $('.table').DataTable({
      paging: true,
      lengthChange: true,
      autoWidth: true,
      processing: true,
      serverSide: true,
      orderable: true,
      searchable: true,
      searchDelay: 1000,
      ordering: false,
      scrollX: true,
      scrollCollapse: true,
      language: {
          processing: "Sedang diproses..."
      },
      ajax: {
        url: '{{route('admin.karya.get_data')}}',
        type:'get',
        contentType: 'application/json',
      },
      columns: [
        {
          data: "id",
          render: function (data, type, row, meta){
            return meta.row + meta.settings._iDisplayStart + 1;
          }
        },
        {data: "nama"},
        {data: "gambar"},
        {data: "keterangan"},
        {data: "pemasar"},
        { data: null,
          render: function ( data, type, row ) {
          return '<div class="btn-group" role="group" aria-label="Basic example">'+
                    '<a class="btn btn-sm btn-info"><i class="fa fa-folder-open-o" aria-hidden="true"></i> Tambah pemasar</a>'+
                    '<button class="btn btn-sm btn-danger" onclick="hapus('+data.id+')"> Hapus</button>'+
                  '</div>';
        }},
      ]
    });
    function simpan(){
      data = $('form').serializeArray();
      $.ajax({
        url:'{{route('admin.user.add_anggota')}}',
        type:'post',
        data:data,
        success: function(data){
          $('.table').DataTable().ajax.reload();
          $('#exampleModalCenter').modal('hide');
        },error: function(data){

        }
      })
    }
    function hapus(id){
      $.ajax({
        url:'{{route('admin.karya.delete')}}',
        type:'post',
        data:{
          '_token':'{{csrf_token()}}',
          id:id
        },success: function(data){
          $('.table').DataTable().ajax.reload();
          Toast.fire({
            icon: 'success',
            title: 'Berhasil menghapus lukisan',
          });
        },error: function(data){
        }
      })
    }
  </script>
@endpush
