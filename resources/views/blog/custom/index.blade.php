@extends('layouts.blog.app')

@section('content')
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          <form id="form_custom">
            
          </form>
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
  @auth
  function tambah_keranjang(id){
    $.ajax({
      url:'{{route('blog.keranjang.tambah')}}',
      type:'post',
      data:{
        '_token':'{{csrf_token()}}',
        id:id,
        user:{{Auth::user()->id}}
      },success:function(data){
        Toast.fire({
          icon: 'success',
          title: 'Berhasil menambah keranjang',
          text: "akan berpindah halaman",
        });
        setTimeout(function(){
          window.location.href = '{{route('blog.keranjang.index')}}'
        }, 3000);
      },error:function(data){
        Toast.fire({
          icon: 'error',
          title: data.responseJSON,
        });
      }
    })
  }
  @endauth
  @guest
    function tambah_keranjang(id){
      Toast.fire({
        icon: 'error',
        title: 'Login terlebih dahulu',
      });
    }
  @endguest
</script>
@endpush
