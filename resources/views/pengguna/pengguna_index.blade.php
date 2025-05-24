@extends('alayoututama')
@section('content')
<div class="row match-height">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="px-3">
                <p class="mb-0"><b><i>Kolom bertanda <code>*)</code> tidak boleh kosong.</i></b></p>
                    <form class="form" action="javascript:save()" method="post" id="form1" name="form1">
                        {{csrf_field()}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label for="email">NIK<span class="text-danger text-bold">*)</span></label>
                                        <input type="text" class="form-control" maxlength="16" id="nik" name="nik" placeholder="Masukkan NIK" required>

                                    </div>

                                    <div class="form-group">
                                        <label for="nama">Nama Lengkap<span class="text-danger text-bold">*)</span></label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Lengkap" required>

                                    </div>

                                    <div class="form-group">
                                            <label for="email">Jabatan<span class="text-danger text-bold">*)</span></label>
                                            <select name="jabatan" id="jabatan" class="form-control" required>
                                                <option value="">--Pilih jabatan--</option>
                                                @foreach($jabatan as $key=>$value)
                                                   <option value="{{$key}}">{{$value}}</option>
                                                @endforeach
                                            </select>
                                    </div>

                                    <hr>

                                     <div class="form-group">

                                        <label for="username">Username <span class="text-danger text-bold">*)</span></label>

                                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukan Username anda." required autofocus>

                                    </div>

                                     <div class="form-group">
                                        <label for="password">Password<span class="text-danger text-bold">*)</span></label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>

                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="form-actions">
                            <a href="{{url('/pengguna')}}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success btn-submit" id="simpan">
                            <i class="fa fa-save"></i> Simpan
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var baseUrl = "{{url('pengguna')}}/";
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

                  
            var nik = $('#nik').val().trim();
            var nama = $('#nama').val().trim();
            var jabatan = $('#jabatan').val().trim();
            var username = $('#username').val().trim();
            var password = $('#password').val().trim();

            // Validasi
            if (nik === '' || nama === '' || jabatan === '' || username === '' || password === '') {
                call_alert('warning', 'Validasi Gagal', 'NIK, Nama, Jabatan, Username, dan Password wajib diisi.');
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
