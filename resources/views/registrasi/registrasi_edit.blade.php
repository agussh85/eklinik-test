@extends('alayoututama')
@section('content')
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-md-12">


        <form class="form-horizontal" role="form" action="javascript:save()" id="form1"> 
        {{csrf_field()}}
        <?php foreach ($hasil as $list) : ?>
        <div class="card">
          <div class="card-body">

              <div class="form-group">
                <div class="row">
                  <div class="col-sm-4">
                    <label for="inputEmail3" class="col-sm-4 control-label">No. Rekam Medis :</label>
                    {{$list->id_pasien}}
                  </div>

                  
                  <div class="col-sm-4">
                    <label for="inputEmail3" class="col-sm-4 control-label">Nama Pasien :</label>
                    {{$list->nama_pasien}}
                  </div>
                </div>
              </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">  
              
              <input type="hidden" class="form-control" id="norm"  name="norm" value="{{$list->id_pasien}}">
              <input type="hidden" class="form-control" id="_token"  name="_token" value="{{csrf_token()}}">
                                                                    
              <div class="form-group">
                <label for="inputEmail3">No Registrasi</label>
                <div class="row">
                    <div class="col-sm-3">
                      <input type="text" name="noregistrasi" id="noregistrasi" class="form-control" value="{{$nourut}}" readonly>
                    </div>
                </div>
              </div>      

              <div class="form-group">
                <label for="email">Dokter<span class="text-danger text-bold"></span></label>
                <div class="row">
                    <div class="col-sm-3">
                      <select name="dokter" id="dokter" class="form-control" required>
                          <option value="">--Pilih Dokter--</option>
                              @foreach($dokter as $value)
                              <option value="{{$value->id_user}}">{{$value->nama}}</option>
                              @endforeach
                      </select>
                    </div>
                </div>
              </div>

                           

              <div class="form-actions">
                <a href="{{url('/pasien')}}" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-success btn-submit" id="simpan">
                  <i class="fa fa-save"></i> Simpan
                </button>
              </div>
              
            

          </div>
        </div>
        <?php endforeach; ?>
        </form>
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
    var baseUrl = "{{url('/registrasi')}}/";

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
