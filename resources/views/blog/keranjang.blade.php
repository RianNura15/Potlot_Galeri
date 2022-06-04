
@extends('layouts.blog.app')

@section('content')
  <!-- ======= Breadcrumbs ======= -->
  <section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2> </h2>
        <ol>
          <li><a href="{{url('/')}}">Home</a></li>
          <li>Keranjang</li>
        </ol>
      </div>

    </div>
  </section><!-- End Breadcrumbs -->

  <!-- ======= Portfolio Details Section ======= -->
  <section id="portfolio-details" class="portfolio-details">
    <div class="container">

      <div class="row gy-4">
          <table class="table">
            <thead>
              <tr>
                <th>No.</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Tanggal</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @php
                $num = 1;
              @endphp
              @forelse ($get as $key => $value)
                <tr>
                  <td>{{$num++}}</td>
                  <td style="width: 25%"><img class="img-fluid img-thumbnail" src="{{asset('public\images')}}\{{$value->gambar}}" alt=""></td>
                  <td>{{$value->nama}}</td>
                  <td>{{rupiah($value->harga)}}</td>
                  <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                  <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                      <button type="button" class="btn btn-success">Bayar</button>
                      <button type="button" class="btn btn-danger">Batalkan</button>
                    </div>
                  </td>
                </tr>
              @empty
                <tr>
                  <td class="text-center" colspan="6">Data Kosong</td>
                </tr>
              @endforelse
            </tbody>
          </table>
      </div>
    </div>
  </section><!-- End Portfolio Details Section -->
@endsection
