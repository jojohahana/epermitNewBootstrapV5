@extends('layouts.navbar')
@section('title', 'Check Izin')
@section('title-content', 'FORM CHECK IZIN CUTI & SAKIT')

@section('content')
@csrf
<form onsubmit="return false" class="needs-validation" id="form_check" method="get">
    <div class="col pb-4">
        <div class="col-md-3">
            <h6>Kategori Izin</h6>
            <select class="js-example-basic-single col-sm-12" id="check_type" name="sick_type">
                <option selected disabled>Pilih Kategori Izin</option>
                    <option value="checkCuti">Izin Cuti</option>
                    <option value="checkSakit">Izin Sakit</option>
            </select>
        </div>
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
                <h4 class="modal-title" id="modalsCheckTitle">List Izin</h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover datatable" id="dataTables_check">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th>Dept</th>
                            <th>Tipe</th>
                            <th>Hari</th>
                            <th>Ket</th>
                            <th>Tgl Izin</th>
                            <th>Status</th>
                            <th>Ket Status</th>
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
                        $("#rf_idCheck").val(data[0]["employee_id"]);
                        $("#nik_Check").val(data[0]["employee_id"]);
                        $('#modalsCheck').modal('show');
                        getIzinDetail(data[0]["employee_id"]);
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

    $('#dataTables_check').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('epermit/checkdtlpermit', ':id') }}",
        columns: [
            {data: 'user_id', name:'user_id'},
            {data: 'name', name:'name'},
            {data: 'department', name:'department'},
            {data: 'leave_type', name:'leave_type'},
            {data: 'day', name:'day'},
            {data: 'reason', name:'reason'},
            {data: 'updated_at', name:'updated_at'},
            {data: 'data_status', name:'data_status'},
        ],
        order:[[0,'desc']]
    });


    // $('#dataTables_check').DataTable();

    function getIzinDetail(id) {
    var route = "{{ route('epermit/checkdtlpermit', ':id') }}";
    route = route.replace(':id', id);
    $.ajax({
        url: route,
        method: 'get',
        dataType: 'json',
        success: function(data) {
            var detailDataset = [];
            count = 0;
            $('#dataTables_check').DataTable().clear().destroy();
            // $('#dataTables_check').DataTable({
            //     "paging": false,
            //     "scrollY": '250px',
            //     "scrollCollapse": true,
            //     data: detailDataset,
            //     columns: [{
            //             title: '#'
            //         },
            //         {
            //             title: 'NIK'
            //         },
            //         {
            //             title: 'Nama'
            //         },
            //         {
            //             title: 'Dept'
            //         },
            //         {
            //             title: 'Jenis Izin'
            //         },
            //         {
            //             title: 'Ttl Hari'
            //         },
            //         {
            //             title: 'Ket'
            //         },
            //         {
            //             title: 'Tgl Submit'
            //         },
            //         // {
            //         //     title: 'Status'
            //         // },
            //         {
            //             title: 'Status'
            //         }
            //     ]
            // });
            for (var i = 0; i < data['dataIzin'].length; i++) {
                count++;
                detailDataset.push([
                    count,
                    data['dataIzin'][i].user_id,
                    data['dataIzin'][i].name,
                    data['dataIzin'][i].department,
                    data['dataIzin'][i].leave_type,
                    data['dataIzin'][i].day,
                    data['dataIzin'][i].reason,
                    data['dataIzin'][i].updated_at,
                    data['dataIzin'][i].data_status
                ]);

            }
        }
    });
}
</script>
@endsection
@endsection
