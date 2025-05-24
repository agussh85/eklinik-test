@extends('alayoututama')
@section('content')

<div><div><div>

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-header">
                                <h4 class="card-title">{{$judulhalaman}}</h4>
                                <div class="card-tools">
                                  <a href="{{url('pengguna/add')}}" class="btn btn-tool" >
                                    <i class="fas fa-plus"></i> Pengguna Baru
                                  </a> 
                                </div>
                            </div>
                            <div class="card-body">
                            <div class="table-responsive">
                                <table  name="example1" id="example1" class="table table-sm">
                                    <thead class="" style="text-align:center">
                                        <tr>
                                            <th>No</th>
                                            <th>Aksi</th>
                                            <th>Username</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        foreach ($datapengguna as $query) {
                                            echo '<tr><td align="center">'.$no.'</td>';
                                            echo '<td align="center">
                                            <a class="btn-sm btn-success" href="/pengguna/edit/'.$query->id_user.'" title="Edit" >
                                            <i class="fa fa-edit"></i></a>
                                            <a class="btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user(' . "'" . $query->id_user . "'" . ')">
                                            <i class="fa fa-trash"></i></a></td>';
                                            ?>
                                            <td>{{$query->username}}</td>
                                            <td>{{$query->nik ? $query->nik : '--'}}</td>
                                            <td>{{$query->nama}}</td>
                                            <td>{{$query->jabatan ? $query->jabatan : '--'}}</td>
                                            
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


  function edit_user(iduser) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('pengguna/edit')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Edit Data OK.');
            //if success reload ajax table
            //reload_table();
            //location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Gagal edit data.');
        }
      });

  }

  
  function delete_user(iduser) {
    if (confirm('Anda yakin akan menghapus data?')) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('pengguna/delete')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Hapus Data OK.');
            //if success reload ajax table
            //reload_table();
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Hpus data gagal.');
        }
      });

    }
  }

  
  function print_user(iduser) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('pengguna/cetak')}}/" + iduser,
        type: "GET",
        dataType: "JSON"
      });

  }
</script>

@endsection
