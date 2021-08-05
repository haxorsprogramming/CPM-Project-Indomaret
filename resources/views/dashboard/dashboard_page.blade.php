<!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
   <title>Dashboard</title>
   <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
   <!-- General CSS Files -->
   <link href="https://fonts.googleapis.com/css?family=Nunito+Sans&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/iziToast.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/jqvmap.min.css">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/summernote-bs4.css">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/owl.carousel.min.css">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/datatables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/style.css">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/nadharesto.css">
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/stisla/css/components.css">
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>
  <link rel="stylesheet" href="{{ asset('/ladun/dashboard') }}/nProg/nprogress.css"/>

 </head>

 <body style="font-family: 'Nunito Sans';">
   <div id="app">
     <div class="main-wrapper">
       <div class="navbar-bg"  style='background-color:#2c3e50;'></div>
       <nav class="navbar navbar-expand-lg main-navbar" id='divNavbar'>
         <form class="form-inline mr-auto">
           <ul class="navbar-nav mr-3">
             <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
           </ul>
         </form>
         <ul class="navbar-nav navbar-right">

           <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
             <img alt="image" src="{{ asset('/ladun/dashboard') }}/img/avatar-1.png" class="rounded-circle mr-1">
             <div class="d-sm-none d-lg-inline-block">Hi, {{ session('user_login') }} (
              @if($tipe_user == 'admin')
                Manajer
              @else
                Kontraktor
              @endif
             )</div></a>
             <div class="dropdown-menu dropdown-menu-right">
               <a href="{{ url('/logout') }}" class="dropdown-item has-icon text-danger">
                 <i class="fas fa-sign-out-alt"></i> Logout
               </a>
             </div>
           </li>
         </ul>
       </nav>
       <div class="main-sidebar" id="divMenu">
        <aside id="sidebar-wrapper">
            <div class="sidebar-brand">
              <a href="#!" style="height:30px;">
              <img src="{{ asset('/ladun/dashboard') }}/img/logo_uinsu.jpg" style="width: 60px;">
              </a>
            </div>
            <div class="sidebar-brand sidebar-brand-sm">
              <a href="#!"></a>
            </div>
            <ul class="sidebar-menu" style="margin-top:20px;">
              <li><a class="nav-link" @click="beranda_atc()" href="#!"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
              <li><a class="nav-link" @click="manajemen_proyek_atc()" href="#!"><i class="fas fa-city"></i><span>Manajemen Proyek</span></a></li>
              <li><a class="nav-link" @click="kegiatan_atc()" href="#!"><i class="fas fa-industry"></i><span>Kegiatan</span></a></li>
              <li><a class="nav-link" @click="sub_kegiatan_atc()" href="#!"><i class="fas fa-sitemap"></i><span>Sub Kegiatan</span></a></li>
              <li><a class="nav-link" @click="manajemen_kegiatan_atc()" href="#!"><i class="fas fa-tasks"></i><span>Manajemen Kegiatan</span></a></li>
              <li><a class="nav-link" @click="laporan_proyek_atc()" href="#!"><i class="fas fa-chart-bar"></i><span>Laporan</span></a></li>
              @if($tipe_user == 'admin')
                <li><a class="nav-link" @click="manajemen_user_atc()" href="#!"><i class="fas fa-user-circle"></i><span>Manajemen User</span></a></li>
              @else

              @endif
              <li><a class="nav-link" href="{{ url('/logout') }}"><i class="fas fa-sign-out-alt"></i> <span>Log Out</span></a></li>
          </ul>
          </aside>
       </div>

       <!-- Main Content -->
       <div class="main-content" id="divMain">
         <section class="section">
           <div class="section-header">
             <h1 id="capUtama"> Aplikasi Manajemen Proyek - @{{ titleApps }} </h1>
           </div>

            <div id="divUtama"></div>
          </section>

     </div>
   </div>
   <footer class="main-footer" id='divFooter'>Copyright &copy; Irwansyah Tamba - Prodi Sistem Informasi, Fakultas Sains dan Teknologi, Universitas Islam Negeri Sumatera Utara </footer>
   <!-- General JS Scripts -->

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   <script src="{{ asset('/ladun/dashboard') }}/stisla/js/popper.js"></script>
   <script src="{{ asset('/ladun/dashboard') }}/stisla/js/bootstrap.min.js"></script>
   <script src="{{ asset('/ladun/dashboard') }}/stisla/js/jquery.nicescroll.min.js"></script>
   <script src="{{ asset('/ladun/dashboard') }}/stisla/js/moment.min.js"></script>
   <script src="{{ asset('/ladun/dashboard') }}/stisla/js/stisla.js"></script>

      <!-- JS Libraries -->
    <script src="{{ asset('/ladun/dashboard') }}/stisla/js/datatables.min.js"></script>
    <script src="{{ asset('/ladun/dashboard') }}/stisla/js/iziToast.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('/ladun/dashboard') }}//stisla/js/scripts.js"></script>

   <!-- Page Specific JS File -->
   <script>
     const server = "{{ url('/') }}/";
   </script>
   <script src="{{ asset('/ladun/dashboard') }}/index.js"></script>
 </body>
 </html>