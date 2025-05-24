@extends('alayoututama')
@section('content')
<div class="main-content">
    <section class="section">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                                
                <h3>{{$totalregistrasi}}<sup style="font-size: 20px"> Registrasi</sup></h3>

                <p>Registrasi Hari Ini</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <?php if( session('jabatan') != 'apoteker') {?>
              <a href="{{url('/registrasi')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
              <?php } else {?>
                <a href="#" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
                <?php } ?>
            </div>
          </div>
        
          <div class="col-lg-3 col-6">
            <!-- small card -->
            <div class="small-box bg-info">
              <div class="inner">
                                
                <h3>{{$totalpasien}}<sup style="font-size: 20px"> Orang</sup></h3>

                <p>Data Pasien</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{url('/pasien')}}" class="small-box-footer">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>
          </div>
        </div>
</section>
</div>



@endsection
