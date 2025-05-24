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
              <?php foreach ($hasil as $list) : ?>
              
              <div class="row">
                <!-- Kolom kiri untuk Foto -->
                <div class="col-md-2 text-center">
                  <div class="form-group">
                    <label>Foto Pasien</label>
                    <div>
                      <img id="preview" 
                        src="{{ $list->foto ? asset('uploads/foto/' . $list->foto) : asset('filefoto/user_default.jpg') }}" 
                        alt="Foto Pasien" 
                        class="img-thumbnail mb-2" 
                        width="200">
                    </div>
                    <input type="file" name="foto" id="foto" class="form-control" accept="image/*" onchange="previewFoto(event)">
                  </div>
                </div>

              <!-- Kolom kanan untuk Form -->
                <div class="col-md-10">  
                  <input type="hidden" class="form-control" id="id"  name="id" value="{{$list->id_pasien}}">
                  <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                  <input type="hidden" class="form-control" id="fotolama"  name="fotolama" value="{{$list->foto}}">
                                        
                                              
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">ID Pasien</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <input type="text" name="idd" id="idd" class="form-control" value="{{$list->id_pasien}}" disabled>
                      </div>
                    </div>
                  </div>         
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">NIK</label>
                    <div class="row">
                      <div class="col-sm-4">
                        <input type="text" name="nik" id="nik" class="form-control" value="{{$list->nik}}" 
                                maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '')" value="" required placeholder="NIK" required>
                      </div>
                    </div>
                  </div>   
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Pasien</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <input type="text" name="nama" id="nama" class="form-control" value="{{$list->nama_pasien}}" required>
                      </div>
                    </div>
                  </div>       
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Alamat</label>
                    <div class="row">
                      <div class="col-sm-10">
                        <textarea name="alamat" id="alamat" row='4' class="form-control"  required>{{$list->alamat}}</textarea>
                      </div>
                    </div>
                  </div>       
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">No Telepon</label>
                    <div class="row">
                      <div class="col-sm-6">
                        <input type="text" name="telepon" id="telepon" class="form-control" value="{{$list->no_telepon}}" required>
                      </div>
                    </div>
                  </div>
                        
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Tanggal Lahir</label>
                    <div class="row">
                      <div class="col-sm-3">
                        <input type="text" name="tempatlahir" id="tempatlahir" class="form-control" value="{{$list->tempat_lahir}}" placeholder="Tempat Lahir" required>
                      </div>
                      <div class="col-sm-3">
                        <input type="date" name="tanggallahir" id="tanggallahir" class="form-control" value="{{$list->tanggal_lahir}}">
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Jenis Kelamin</label>
                    <div class="row">
                      <div class="col-sm-3">
                          <select name="jeniskelamin" class="form-control">
                            <?php if($list->jenis_kelamin=='L') { ?>
                                  <option value='L'>Laki-laki</option>
                                  <option value='P'>Perempuan</option>                      
                            <?php } else { ?>
                                  <option value='P'>Perempuan</option>  
                                  <option value='L'>Laki-laki</option>
                            <?php } ?>
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
              <?php endforeach; ?>
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
    var baseUrl = "{{url('/pasien')}}/";


    
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
