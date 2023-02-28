@extends('layouts.navbar')
@section('title', 'Check Izin Sakit')
@section('title-content', 'CHECK IZIN SAKIT')

@section('content')
@csrf
<form onsubmit="return false" class="needs-validation" id="form_checkSakit" method="get">
    <div class="col pb-4">
        {{-- <div class="col-md-3">
            <h6>Kategori Izin</h6>
            <select class="js-example-basic-single col-sm-12" id="check_type" name="sick_type">
                <option selected disabled>Pilih Kategori Izin</option>
                    <option value="checkCuti">Izin Cuti</option>
                    <option value="checkSakit">Izin Sakit</option>
            </select>
        </div> --}}
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
<div class="modal fade bs-example-modal-lg" id="modalsCheckSick" tab-index="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">List Izin Sakit</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover datatable" id="dataTables_checkSick">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>No Izin</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Dept</th>
                            <th>Tipe</th>
                            <th>Hari</th>
                            {{-- <th width="40%">Ket</th> --}}
                            <th>Tgl Izin</th>
                            <th>Status</th>
                            <th>Action</th>
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
                        $('#modalsCheckSick').modal('show');
                        getSakitDetail(x);
                        // $("#check_type").focus();
                    }
                },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Belum ada izin sakit nih !!'
                        });
                }
            });
        }
    });


    function getSakitDetail(id) {
            console.log(id);
            $('#dataTables_checkSick').dataTable().fnClearTable();
            $('#dataTables_checkSick').dataTable().fnDestroy();
    var route = "{{ route('epermit/checkdtlsakit', ':id') }}";
    route = route.replace(':id', id);
    $.ajax({
        url: route,
        method: 'get',
        dataType: 'json',
        success: function(data) {
            // console.log();
            var detailDataset = [];
            count = 0;
            for (var i = 0; i < data['dataSakit'].length; i++) {
                count++;
                var sick_id = data['dataSakit'][i]['sick_id'];
                detailDataset.push([
                    count,
                    data['dataSakit'][i]['sick_id'],
                    data['dataSakit'][i]['user_id'],
                    data['dataSakit'][i]['name'],
                    data['dataSakit'][i]['department'],
                    data['dataSakit'][i]['sick_type'],
                    data['dataSakit'][i]['day'],
                    data['dataSakit'][i]['updated_at'],
                    data['dataSakit'][i]['data_status'],
                    '<button type="button" class="btn btn-danger mb-3" onclick="del_Checkpermit('+sick_id+')">Hapus</button>'
                ]);
            }
            $('#dataTables_checkSick').DataTable({
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
                }

    });
}

function del_Checkpermit(id){
    var route = "{{ route('epermit/delCheckSick', ':id') }}";
    route = route.replace(':id', id);
    $.ajax({
        url: route,
        method: 'post',
        success: function(data) {
            // console.log(data);
            var emp_nik = data['nik'];
            getSakitDetail(emp_nik);
            Swal.fire({
                        icon: 'success',
                        title: 'Yuhuuu...',
                        text: 'Success Deleted'
                        });
        },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Data not found'
                        });
                }
    });
}
</script>
@endsection
@endsection
