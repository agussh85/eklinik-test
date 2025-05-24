@extends('alayoututama')
@section('content')
<div><div><div>

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="card-header">
                                <h4 class="card-title">{{$judulhalaman}}</h4>
                                <div class="card-tools">
                                  <a href="{{url('obat/add')}}" class="btn btn-tool" >
                                    <i class="fas fa-plus"></i> Tambah Obat
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
                                            <th>Kode Obat</th>
                                            <th>Nama Obat</th>
                                            <th>Satuan</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Keterangan</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                        $no = 1;
                                        foreach ($dataobat as $query) {
                                            if(empty($query->keterangan)) $query->keterangan="--";
                                            echo '<tr><td align="center">'.$no.'</td>';
                                            echo '<td align="center">
                                            <a class="btn-sm btn-success" href="/obat/edit/'.$query->id_obat.'" title="Edit" >
                                            <i class="fa fa-edit"></i></a>
                                            <a class="btn-sm btn-danger" href="javascript:void(0)" title="Delete" onclick="delete_user(' . "'" . $query->id_obat . "'" . ')">
                                            <i class="fa fa-trash"></i></a></td>';
                                            ?>
                                            <td style="text-align: center;">{{$query->code}}</td>
                                            <td>{{$query->nama_obat}}</td>
                                            <td style="text-align: center;">{{$query->satuan}}</td>
                                            <td style="text-align: right;">{{$query->jumlah}}</td>
                                            <td style="text-align: right;">Rp {{ number_format($query->harga, 0, ',', '.') }}</td>
                                            <td>{{$query->keterangan}}</td>
                                            
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
        url: "{{url('obat/edit')}}/" + iduser,
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
        url: "{{url('obat/delete')}}/" + iduser,
        type: "GET",
        dataType: "JSON",
        success: function(data) {

            call_alert('success', 'Success', 'Hapus Data OK.');
            //if success reload ajax table
            //reload_table();
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown) {
          call_alert('error', 'Warning', 'Hapus data gagal.');
        }
      });

    }
  }

  
  function print_user(iduser) {
      // ajax delete data to database
      $.ajax({
        url: "{{url('obat/cetak')}}/" + iduser,
        type: "GET",
        dataType: "JSON"
      });

  }
</script>

@endsection
