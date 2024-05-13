<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">
    <title>Intervention's - @yield('title')</title>

    @include('partials.head')
    @vite( [
          'resources/css/app.css',
          'resources/js/app.js',
      ])
      <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
      <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start       -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
        @include('partials.navbar')
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper sidebar-icon">
        <!-- Page Sidebar Start-->
            @include('partials.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <!-- Container-fluid starts-->
            @yield('content')
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
            @include('partials.footer')
      </div>
    </div>
    @include('partials.scripts')
    <!-- login js-->
    <!-- Plugin used-->

    <script>
      // new TomSelect('select')
//       document.addEventListener('DOMContentLoaded', function() {
//     // Sélection de tous les éléments <select> dans le document
//     const selects = document.querySelectorAll('select');

//     // Initialisation de TomSelect pour chaque élément <select>
//     selects.forEach(function(select) {
//         new TomSelect(select);
//     });
// })
new TomSelect('select[multiple]',{plugins:{remove_button:{title:'Supprimer'}}})

    </script>
    
  </body>
</html>