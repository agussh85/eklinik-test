 
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
     <!-- Left navbar links -->
     <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/dashboard')}}" class="nav-link">Dashboard</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/login/logout')}}" class="nav-link">Log Out</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="navbar-nav">
				<a class="nav-link"  ><span class='fa fa-calendar'></span>&nbsp;<?php echo gmdate("M d , Y");?>&nbsp;<span id="clock"></span></a>
			</li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            
            <a href="{{url('/login/logout')}}" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
          
        </div>
      </li>

    </ul>
  </nav>
  <!-- /.navbar -->

   <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{url('fileicon/logo.png')}}"
           alt="eKlinik"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">eKlinik</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2" style="font-size:0.9em">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <!-- <li class="nav-item has-treeview menu-open"> 
                <span class="badge badge-info right">6</span>-->
          @if (session('jabatan') == 'apoteker' ||  session('jabatan') == 'admin' )
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Data Master
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if (session('jabatan') == 'admin')
                    <li class="nav-item">
                        <a href="{{ url('/pengguna') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Pengguna</p>
                        </a>
                    </li>
                @endif

                @if (session('jabatan') == 'apoteker' || session('jabatan') == 'admin')
                    <li class="nav-item">
                        <a href="{{ url('/obat') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Data Obat</p>
                        </a>
                    </li>
                @endif
            </ul>

          </li>
          @endif

          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Pendaftaran Pasien
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                @if (session('jabatan') == 'pendaftaran' ||  session('jabatan') == 'admin' )
                <li class="nav-item">
                    <a href="{{ url('/pasien/add') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pasien Baru</p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ url('/pasien') }}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Daftar Pasien</p>
                    </a>
                </li>
            </ul>
          </li>

          
          <li class="nav-item has-treeview">
            <a href="{{ url('/registrasi') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Registrasi Pasien
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>



        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>