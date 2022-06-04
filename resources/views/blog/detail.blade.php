
@extends('layouts.blog.app')

@section('content')
  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>{{$get->nama}}</h2>
        <ol>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>{{$get->nama}}</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="row gy-4">

        <div class="col-lg-8">
          <div class="portfolio-details-slider swiper">
            <div class="swiper-wrapper align-items-center">
              <div class="swiper-slide">
                <img src="{{asset('public\images')}}/{{$get->gambar}}" alt="">
              </div>

            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="portfolio-info">
            <h3>Detail</h3>
            <ul>
              <li><strong>Nama</strong>: {{$get->nama}}</li>
              <li><strong>Publikasi</strong>: {{date('d-m-Y',strtotime($get->created_at))}}</li>
              <li><strong>Harga</strong>: {{rupiah($get->harga)}}</li>
              <li><button onclick="tambah_keranjang({{$get->id}})" class="btn btn-warning" type="button" name="button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Tambahkan Troli</button> </li>
            </ul>
          </div>
          <div class="portfolio-description">
            <p>{{$get->keterangan}}</p>
          </div>
        </div>

      </div>

    </div>
  </section><!-- End Portfolio Details Section -->
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
</script>
@endpush
