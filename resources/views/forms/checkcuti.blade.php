@extends('layouts.navbar')
@section('title', 'Check Cuti')
@section('title-content', 'CHECK IZIN CUTI')

@section('content')
@csrf
<form onsubmit="return false" class="needs-validation" id="form_check" method="get">
    <div class="col pb-4">
        <div class="col-md-3 pt-3">
          <h6>NIK</h6>
          <input class="form-control" id="rf_idCheck" name="rf_idCheck" autofocus type="text" autofocus placeholder="Masukkan NIK Anda">
          <input class="form-control" id="nik_Check" name="nik_Check" type="hidden" value="">
            @error('nik_Check')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>

    </div>
</form>

{{-- MODAL LIST IZIN - USER CHECK  --}}
<div class="modal fade bs-example-modal-lg" id="modalsCheck" tab-index="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalsCheckTitle">List Izin Cuti</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover datatable" id="dataTables_check">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Dept</th>
                            <th>Tipe</th>
                            <th>Hari</th>
                            <th width="40%">Ket</th>
                            <th>Tgl Izin</th>
                            <th>Status</th>
                            <th>Action</th>
                            {{-- <th>Ket Status</th> --}}
                            {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody></tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
{{-- </div> --}}
@section('script')
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on("keypress", "#rf_idCheck", function (e){
        let val_nik = $(this).val();
        let post_url = "{{ route('epermit/getemployee', ':id') }}";
        post_url = post_url.replace(':id', val_nik);
        if (e.keyCode == 13){
            $.ajax({
                url: post_url,
                type: "get",
                dataType: "json",
                success: function(data){
                    if(data == null || data == ''){
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Data Karyawan Tidak Ditemukan'
                            });
                            $("#rf_idCheck").val('');
                            $("#nik_Check").val('');

                    }else{
                        console.log(data[0]["employee_id"]);
                        var x=data[0]["employee_id"];
                        $("#rf_idCheck").val(data[0]["employee_id"]);
                        $("#nik_Check").val(data[0]["employee_id"]);
                        $('#modalsCheck').modal('show');
                        getIzinDetail(x);
                        // $("#check_type").focus();
                    }
                },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Input NIK Terlebih Dulu'
                        });
                }
            });
        }
    });


    function getIzinDetail(id) {
            console.log(id);
    var route = "{{ route('epermit/checkdtlpermit', ':id') }}";
    route = route.replace(':id', id);
    $.ajax({
        url: route,
        method: 'get',
        dataType: 'json',
        success: function(data) {
            // console.log();
            var detailDataset = [];
            count = 0;
            // $('#dataTables_check').DataTable().clear().destroy();
            for (var i = 0; i < data['dataIzin'].length; i++) {
                count++;
                detailDataset.push([
                    count,
                    data['dataIzin'][i]['user_id'],
                    data['dataIzin'][i]['name'],
                    data['dataIzin'][i]['department'],
                    data['dataIzin'][i]['leave_type'],
                    data['dataIzin'][i]['day'],
                    data['dataIzin'][i]['leave_reason'],
                    data['dataIzin'][i]['updated_at'],
                    data['dataIzin'][i]['data_status'],
                    '<button type="button" class="btn btn-danger mb-3" onclick="del_Checkpermit('+count+')">Hapus</button>'
                ]);

            }
            $('#dataTables_check').DataTable({
                "paging": false,
                "scrollY": '250px',
                "scrollCollapse": true,
                data: detailDataset

            });
        },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data not found'
                        });
                    // console.log(data);
                }

    });
}

function del_Checkpermit(id){
    console.log(id);
var route = "{{ route('epermit/delCheckCuti/', ':id') }}";
route = route.replace(':id', id);

}
</script>
@endsection
@endsection
