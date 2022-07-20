<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{asset('public\sb_admin\css\sb-admin-2.min.css')}}">
    <link rel="stylesheet" href="{{asset('public\sb_admin\vendor\fontawesome-free\css\all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public\sb_admin\vendor\datatables\dataTables.bootstrap4.min.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{asset('public\select2\dist\css\select2.min.css')}}" rel="stylesheet" />

</head>
<body id="page-top">

  <div id="wrapper">

        @include('layouts.admin.sidebar')
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
              @include('layouts.admin.navbar')
              @yield('content')
            </div>
          </div>
    </div>
    <script src="{{asset('public\sb_admin\vendor\jquery\jquery.min.js')}}"></script>
    <script src="{{asset('public\sb_admin\vendor\bootstrap\js\bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public\sb_admin\vendor\jquery-easing\jquery.easing.min.js')}}"></script>
    <script src="{{asset('public\sb_admin\js\sb-admin-2.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('public\sb_admin\vendor\datatables\jquery.dataTables.min.js')}}" charset="utf-8"></script>
    <script src="{{asset('public\sweetalert2\dist\sweetalert2.all.min.js')}}"></script>
    <script src="{{asset('public\select2\dist\js\select2.min.js')}}"></script>
    <script type="text/javascript">
    function rupiah(angka){
      let prefix = 'Rp. ';
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split   		= number_string.split(','),
      sisa     		= split[0].length % 3,
      rupiah     		= split[0].substr(0, sisa),
      ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

      // tambahkan titik jika yang di input sudah menjadi angka ribuan
      if(ribuan){
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
      }
    </script>
    @stack('script')
</body>
</html>
