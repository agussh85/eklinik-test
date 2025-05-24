@extends('alayoututama')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-body">
            <form class="form-horizontal" role="form" action="javascript:save()" id="form1">   
              {{csrf_field()}}


              <div class="row">
              <!-- Kolom kanan untuk Form -->
                <div class="col-md-10">

                  <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                  <input type="hidden" name="id" id="id"  value="{{$query->id_obat}}">
                              
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Kode Obat</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="kodeobat" id="kodeobat" class="form-control" 
                                maxlength="16"  required placeholder="Kode Obat" required value="{{$query->code}}">
                      </div>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Obat</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <input type="text" name="nama" id="nama" class="form-control"  required placeholder="Nama Obat" value="{{$query->nama_obat}}">
                      </div>
                    </div>
                  </div>       
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Satuan</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="satuan" id="satuan" class="form-control" placeholder="Satuan" required value="{{$query->satuan}}">
                      </div>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Jumlah</label>
                    <div class="row">
                      <div class="col-sm-2">
                        <input type="text" name="jumlah" id="jumlah" class="form-control" 
                                maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  required placeholder="Jumlah" required value="{{$query->jumlah}}">
                      </div>
                    </div>
                  </div>     
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Harga</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="harga" id="harga" class="form-control" 
                                maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')"  required placeholder="Harga" required value="{{$query->harga}}">
                      </div>
                    </div>
                  </div>
                                                   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Keterangan</label>
                    <div class="row">
                      <div class="col-sm-12">
                        <textarea name="keterangan" id="keterangan" row='6' class="form-control" value=""  placeholder="Keterangan">{{$query->keterangan}}</textarea>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              



              <div class="form-actions">
                <a href="{{url('/obat')}}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-success btn-submit" id="simpan">
                  <i class="fa fa-save"></i> Simpan
                </button>
              </div>
            </form>

          </div>
        </div>
      </div>



    </div>

  </section>

</div>


<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

<script>
    var baseUrl = "{{url('/obat')}}/";


        function call_alert(type, title, content, timer = '') {
            if (timer == '') {
                timer = 3000;
            }
            Swal.fire({
                allowOutsideClick: false,
                icon: type,
                title: title,
                timer: timer,
                text: content,
            }).then(() => {

            });
        }

        function save() {
          
            var id = $('#id').val().trim();
            
            var kodeobat = $('#kodeobat').val().trim();
            var nama = $('#nama').val().trim();
            var satuan = $('#satuan').val().trim();
            var jumlah = $('#jumlah').val().trim();
            var harga = $('#harga').val().trim();
            var keterangan = $('#keterangan').val().trim();
            
            // Validasi
            if (kodeobat === '' || nama === '' || satuan === '' || jumlah === '' || harga === '') {
                call_alert('warning', 'Validasi Gagal', 'NIK, Nama, Satuan, Jumlah, dan Harga wajib diisi.');
                return;
            }


            var form = $('#form1')[0];
            var formData = new FormData(form);

            //btnLoader(true);

            $.ajax({
                url: baseUrl + 'update',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            call_alert('success', 'Success', 'Data saved successfully.');
                    } else {
                        call_alert('error', 'Warning', 'Failed to save data.');
                    }
                },
                error: function() {
                    call_alert('error', 'Warning', 'Failed to save data.');
                }
            });
        }

</script>

@endsection
