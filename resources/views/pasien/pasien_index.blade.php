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
                <!-- Kolom kiri untuk Foto -->
                <div class="col-md-2 text-center">
                  <div class="form-group">
                    <label>Foto Pasien</label>
                    <div>
                      <img id="preview" src="{{ asset('filefoto/user_default.jpg') }}" alt="Foto Pasien" class="img-thumbnail mb-2" width="200">
                    </div>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*" onchange="previewFoto(event)">
                  </div>
                </div>

              <!-- Kolom kanan untuk Form -->
                <div class="col-md-10">

                  <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                                                        
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">No Rekam Medis</label>
                    <div class="row">
                      <div class="col-sm-3">
                        <input type="text" name="id" id="id" class="form-control" value="{{$nourut}}" readonly>
                      </div>
                    </div>
                  </div>      
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">NIK</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="nik" id="nik" class="form-control" 
                                maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="" required placeholder="NIK" required>
                      </div>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Pasien</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <input type="text" name="nama" id="nama" class="form-control" value="" required placeholder="Nama Pasien">
                      </div>
                    </div>
                  </div>       
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Alamat</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <textarea name="alamat" id="alamat" row='6' class="form-control" value="" required placeholder="Alamat"></textarea>
                      </div>
                    </div>
                  </div>       
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">No. Telepon</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="telepon" id="telepon" class="form-control" 
                                maxlength="12" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="" required placeholder="No. Telepon" required>
                      </div>
                    </div>
                  </div>
                                                   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Tempat, Tanggal Lahir</label>
                    <div class="row">
                      <div class="col-sm-3">
                        <input type="text" name="tempatlahir" id="tempatlahir" class="form-control" value="" placeholder="Tempat Lahir" required>
                      </div>
                      <div class="col-sm-2">
                        <input type="date" name="tanggallahir" id="tanggallahir" class="form-control" value="<?= date('Y-m-d');?>">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Jenis Kelamin</label>
                    <div class="row">
                      <div class="col-sm-3">
                          <select name="jeniskelamin" class="form-control">
                                  <option value='L'>Laki-laki</option>
                                  <option value='P'>Perempuan</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              



              <div class="form-actions">
                <a href="{{url('/pasien')}}" class="btn btn-danger">Kembali</a>
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
    var baseUrl = "{{url('pasien')}}/";
    var baseUrlNull = '{{ url("/") }}/'; 

    
        function previewFoto(event) {
            const input = event.target;
            const reader = new FileReader();

            reader.onload = function(){
                const imgElement = document.getElementById('preview');
                imgElement.src = reader.result;
            }

            if(input.files && input.files[0]) {
                reader.readAsDataURL(input.files[0]);
            }
        }
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

                  
            var nik = $('#nik').val().trim();
            var nama = $('#nama').val().trim();
            var alamat = $('#alamat').val().trim();
            var telepon = $('#telepon').val().trim();
            var tempat = $('#tempatlahir').val().trim();

            // Validasi
            if (nik === '' || nama === '' || alamat === '' || telepon === '' || tempat === '') {
                call_alert('warning', 'Validasi Gagal', 'NIK, Nama, Alamat, No Telepon, dan Tempat Tanggal Lahir wajib diisi.');
                return;
            }

            if (!/^\d+$/.test(telepon)) {
                call_alert('warning', 'Validasi Gagal', 'No Telepon hanya boleh berisi angka.');
                return;
            }

            if (telepon.length > 12) {
                call_alert('warning', 'Validasi Gagal', 'No Telepon maksimal 12 digit.');
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
                            
                            // Kembali ke gambar default
                            document.getElementById("preview").src = baseUrlNull + 'filefoto/user_default.jpg';

                            call_alert('success', 'Success', 'Data saved successfully.');
                            
                            // Reload halaman setelah sukses
                            setTimeout(function () {
                                location.reload();
                            }, 1500); // delay 1.5 detik agar alert bisa tampil dulu
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
