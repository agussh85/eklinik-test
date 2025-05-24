<!DOCTYPE html>

<?php $username = Session::get('username'); 

date_default_timezone_set("Asia/Jakarta");?>
<html lang="en" class="loading">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">

        <title>{{$judulhalaman}}</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{url('fileicon/logo.png')}}">
        <link rel="shortcut icon" type="image/png" href="{{url('fileicon/logo.png')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{url('app-assets/admin/admin/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{url('app-assets/admin/admin/dist/css/adminlte.min.css')}}">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        <!-- DataTables -->
        <link rel="stylesheet" href="{{url('app-assets/admin/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">

        <!-- summernote -->
        <link rel="stylesheet" href="{{url('app-assets/admin/admin/plugins/summernote/summernote-bs4.css')}}">


			<script type="text/javascript">
			  var detik = <?php echo date('s'); ?>;
			  var menit = <?php echo date('i'); ?>;
			  var jam = <?php echo date('H'); ?>;
		
			  function clock(){
			    if (detik!=0 && detik%60==0) {
			      menit++;detik=0;
			    }
			    second = detik;
			
			    if (menit!=0 && menit%60==0) {
			      jam++;menit=0;
			    }
			    minute = menit;
			
			    if (jam!=0 && jam%24==0) {
			      jam=0;
		      }
		      hour = jam;
			
			    if (detik<10){
			      second='0'+detik;
			    }
			    if (menit<10){
			      minute='0'+menit;
			    }
			
			    if (jam<10){
			      hour='0'+jam;
			    }
			    waktu = hour+':'+minute+':'+second;
			
			    document.getElementById("clock").innerHTML = waktu;
			      detik++;
			    }
			
			  setInterval(clock,1000);
			</script>	

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    </head>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <body class="hold-transition sidebar-mini sidebar-collapse">
        <div class="wrapper">

            @include('alayoutmenu')
            <?php $judulhalaman="";?>
            <div class="content-wrapper"><!--Statistics cards Starts-->
                <!-- Content Header (Page header) -->
                <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{$judulmodul}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{$judulmodul}}</li>
                        </ol>
                    </div>
                    </div>
                </div><!-- /.container-fluid -->
                </section>
                <section class="content">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>
            </div>
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0 | Agus Sofyan H
    </div>
    <strong>Copyright &copy; 2025<a href="#"> {{ Session::get('footeraplikasi') }}</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
        </div>
<!-- ////////////////////////////////////////////////////////////////////////////-->



<!-- jQuery -->
<script src="{{url('app-assets/admin/admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('app-assets/admin/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('app-assets/admin/admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{url('app-assets/admin/admin/dist/js/demo.js')}}"></script>

<!--     <script src="{{url('app-assets/admin/admin/map/mapdata.js')}}"></script>
    <script src="{{url('app-assets/admin/admin/map/countrymap.js')}}"></script>

Bootstrap 4 -->
<script src="{{url('app-assets/admin/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{url('app-assets/admin/admin/plugins/chart.js/Chart.min.js')}}"></script>


    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{url('app-assets/admin/js/sweetalert2.all.min.js')}}"></script>
<!-- DataTables -->
<script src="{{url('app-assets/admin/admin/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{url('app-assets/admin/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
<!--------------------------------------------->

<script src="{{url('app-assets/admin/admin/sweetalert2.all.min.js')}}"></script>
<!-- Summernote -->
<script src="{{url('app-assets/admin/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>

<script>
  $(function () {
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });

  
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>

<script>



  </body>
</html>
