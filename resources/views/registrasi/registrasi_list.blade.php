@extends('alayoututama')
@section('content')
<div><div><div>

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-header">
                                <h4 class="card-title">{{$judulhalaman}}</h4>
                            </div>
                            <div class="card-body">
                                               
                            <form id="formCari" onsubmit="return cariByTanggal()">
                              <div class="form-group">
                                <label for="inputEmail3" class="col-sm-4 control-label">Tanggal Registrasi</label>
                                <div class="row">
                                  <div class="col-sm-2">
                                    <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$tgl}}">
                                  </div>
                                  <div class="col-sm-2">
                                    <div class="form-actions">
                                      <button type="submit" class="btn btn-success btn-submit" id="simpan">
                                      <i class="fa fa-search"></i> Cari
                                      </button>
                                  </div>

                                  </div>
                                  
                                </div>
                              </div>
                            </form>
                            <div class="table-responsive">
                                <table  name="example1" id="example1" class="table table-sm">
                                    <thead class="" style="text-align:center">
                                        <tr>
                                            <th>No</th>
                                            <th>Data Pasien</th>
                                            <th>Pemeriksaan</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        foreach ($dataregistrasi as $query) {
                                            echo '<tr><td align="center">'.$no.'</td>';
                                            ?>
                                            <td>
                                              <div>
                                                <div class="info-row">
                                                  <div class="info-label">No. Registrasi</div>
                                                  <div class="info-value">: {{ $query->noregistrasi }}</div>
                                                </div>
                                                <div class="info-row">
                                                  <div class="info-label">Tgl Registrasi</div>
                                                  <div class="info-value">: {{ $query->tanggal_registrasi }}</div>
                                                </div>
                                                <div class="info-row">
                                                  <div class="info-label">No. Rekam Medis</div>
                                                  <div class="info-value">: {{ $query->norm }}</div>
                                                </div>
                                                <div class="info-row">
                                                  <div class="info-label">Nama Pasien</div>
                                                  <div class="info-value">: {{ $query->nama_pasien }}</div>
                                                </div>
                                                <div class="info-row">
                                                  <div class="info-label">Dokter</div>
                                                  <div class="info-value">: {{ $query->namapegawai }}</div>
                                                </div>
                                                <br>
                                                <div>
                                                  <?php if(!isset($query->tgl_pemeriksaan_perawat) &&  session('jabatan') == 'perawat') {?>
                                                          <a href="{{url('/pemeriksaanperawat')}}/{{ $query->noregistrasi }}" class="btn btn-dark">Pemeriksaan Perawat</a>
                                                  <?php } ?>
                                                  <?php if(!isset($query->tgl_pemeriksaan_dokter) &&  session('jabatan') == 'dokter') {?>
                                                          <a href="{{url('/pemeriksaandokter')}}/{{ $query->noregistrasi }}" class="btn btn-danger">Pemeriksaan Dokter</a>
                                                  <?php } ?>
                                                </div>
                                              </div>
                                            </td>
                                            <td>
                                              <p>
                                                <b>PEMERIKSAAN PERAWAT</b>
                                                <div>
                                                  <div class="info-row">
                                                    <div class="info-label">Tanggal Pemeriksaan</div>
                                                    <div class="info-value">: {{ $query->tgl_pemeriksaan_perawat }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Nama Perawat</div>
                                                    <div class="info-value">: {{ $query->namaperawat }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Berat Badan</div>
                                                    <div class="info-value">: {{ $query->beratbadan }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Tinggi Badan</div>
                                                    <div class="info-value">: {{ $query->tinggibadan }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Tekanan Darah</div>
                                                    <div class="info-value">: {{ $query->tekanandarah }}</div>
                                                  </div>
                                                </div>
                                              </p>
                                              <hr>
                                              <p>
                                                <b>PEMERIKSAAN DOKTER</b>
                                                  <div class="info-row">
                                                    <div class="info-label">Tanggal Pemeriksaan</div>
                                                    <div class="info-value">: {{ $query->tgl_pemeriksaan_dokter }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Nama Perawat</div>
                                                    <div class="info-value">: {{ $query->namadokter }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Berat Badan</div>
                                                    <div class="info-value">: {{ $query->keluhan }}</div>
                                                  </div>
                                                  <div class="info-row">
                                                    <div class="info-label">Tinggi Badan</div>
                                                    <div class="info-value">: {{ $query->diagnosa }}</div>
                                                  </div>
                                              </p>
                                              <hr>
                                            </td>
                                            </tr>
                                            <?php
                                            $no++;
                                        }?>
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


<script type="text/javascript">

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

  function reload_table() {
    ('#table').ajax.reload(null, false); //reload datatable ajax
  }

  
  function cariByTanggal() {
      const tgl = document.getElementById('tanggal').value;
      if (tgl) {
          window.location.href = '/registrasi/' + tgl;
      }
      return false; // mencegah submit form biasa
  }

  function edit_user(iduser) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('/kelurahan/edit')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Delete edit OK.');
            //if success reload ajax table
            //reload_table();
            //location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Failed to edit data.');
        }
      });

  }

  
  function delete_user(iduser) {
    if (confirm('Are you sure delete this data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('/kelurahan/delete')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Delete Data OK.');
            //if success reload ajax table
            //reload_table();
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Failed to delete data.');
        }
      });

    }
  }
</script>

<style>
  .info-row {
    display: flex;
    margin-bottom: 4px;
  }

  .info-label {
    width: 150px;
    font-weight: bold;
  }

  .info-value {
    flex: 1;
  }
</style>
@endsection
