@extends('layouts.navbar')
@section('title', 'Check Izin')
@section('title-content', 'FORM CHECK IZIN CUTI & SAKIT')

@section('content')
@csrf
<form class="needs-validation" id="form_check" method="get">
    <div class="col pb-4">
        <div class="col-md-3 pt-3">
          <h6>NIK</h6>
          <input class="form-control" id="rf_id" name="rf_id" autofocus type="text" autofocus placeholder="Masukkan NIK Anda">
          <input class="form-control" id="nik" name="nik" type="hidden" value="">
            @error('nik')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col mt-4">
            <h6>Kategori Izin</h6>
            <select class="js-example-basic-single col-sm-12" id="check_type" name="sick_type">
                <option selected disabled>Pilih Kategori Izin</option>
                    <option value="checkCuti">Izin Cuti</option>
                    <option value="checkSakit">Izin Sakit</option>
            </select>
        </div>
    </div>
    <div class="pt-3 pb-6">
        <button class="btn btn-primary check_izin" name="modalsCheck" data-bs-toggle="modal" data-bs-target="#modalsCheck" type="button">CHECK IZIN</button>
        <button class="btn btn-danger" type="reset">RESET</button>
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

    $(document).on("keypress", "#rf_id", function (e){
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
                            $("#rf_id").val('');
                            $("#nik").val('');
                    }else{
                        $("#rf_id").val(data[0]["employee_id"]);
                        $("#nik").val(data[0]["employee_id"]);
                        $("#check_type").focus();
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

    $('.modal-body').append('<table class="table datatable" id="dataTables_check">'+
    '<thead>'+
        '<tr>'+
            '<th>NIK</th>'+
            '<th>Nama</th>'+
            '<th>Dept</th>'+
            '<th>Tipe Izin</th>'+
            '<th>Lama Izin</th>'+
            '<th>Alasan Izin</th>'+
            '<th>Tgl Izin</th>'+
            '<th>Status</th>'+
        '</tr>'+
    '</thead>'+
    '<tbody>'+
    '</tbody>');

    $('#dataTables_check').DataTable();
</script>
@endsection
@endsection
