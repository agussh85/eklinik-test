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
                              
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Kode Obat</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="kodeobat" id="kodeobat" class="form-control" 
                                maxlength="16"  value="" required placeholder="Kode Obat" required>
                      </div>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Obat</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <input type="text" name="nama" id="nama" class="form-control" value="" required placeholder="Nama Obat">
                      </div>
                    </div>
                  </div>       
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Satuan</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="satuan" id="satuan" class="form-control" value="" placeholder="Satuan" required>
                      </div>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Jumlah</label>
                    <div class="row">
                      <div class="col-sm-2">
                        <input type="text" name="jumlah" id="jumlah" class="form-control" 
                                maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="" required placeholder="Julah" required>
                      </div>
                    </div>
                  </div>     
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Harga</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="harga" id="harga" class="form-control" 
                                maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="" required placeholder="Harga" required>
                      </div>
                    </div>
                  </div>
                                                   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Keterangan</label>
                    <div class="row">
                      <div class="col-sm-12">
                        <textarea name="keterangan" id="keterangan" row='6' class="form-control" value=""  placeholder="Keterangan"></textarea>
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
    var baseUrl = "{{url('obat')}}/";
    var baseUrlNull = '{{ url("/") }}/'; 

    
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
                url: baseUrl + 'save',
                dataType: 'json',
                method: 'post',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data.status) {
                            document.getElementById("form1").reset();
                            
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
