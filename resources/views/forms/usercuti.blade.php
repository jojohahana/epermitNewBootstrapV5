@extends('layouts.navbar')
@section('title', 'Izin Cuti')
@section('title-content', 'FORM CUTI KARYAWAN')

@section('content')
<div class="row">
    {{-- Isi konten form  --}}
    <div class="col-xxl-6 col-lg-6">
        <form id="form_cuti"  method="post">
            @csrf
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">NIK <span class="text-danger">*</span></label>
                    <input class="form-control" id="rf_id" name="rf_id" autofocus type="text" placeholder="Masukkan NIK Anda">
                    <input class="form-control" id="nik" name="nik" type="hidden" value="">
                    @error('nik')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                    <input class="form-control" id="nama" readonly type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Departemen</label>
                    <input class="form-control" id="dept" readonly type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Posisi</label>
                    <input class="form-control" id="posisi" readonly type="text" value="" required="">
                </div>
            </div>
            <div class="col pb-4">
                <h6>Jenis Cuti <span class="text-danger">*</span></h6>
                <select class="js-example-basic-single col-sm-12" id="leaves_type" name="leaves_type">
                    <option selected disabled>Pilih Jenis Cuti</option>
                        <option value="CT">Tahunan</option>
                        <option value="CB">Besar</option>
                        <option value="CK">Khusus</option>
                </select>
            </div>
            <div class="row date-picker">
                <h6>Tanggal Cuti</h6>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>From <span class="text-danger">*</span></label>
                        <input class="datepicker-here form-control digits from_date" id="from_date" name="from_date" type="text"  data-language="en">
                        @error('from_date')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group" >
                        <label>To <span class="text-danger">*</span></label>
                        <input class="datepicker-here form-control digits to_date" id="to_date"  name="to_date" type="text"  data-language="en">
                        @error('to_date')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                </div>
            </div>
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="tot_apply_cuti">Cuti Diambil</label>
                    <input class="form-control" id="tot_apply_cuti" name="tot_apply_cuti" readonly type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="tot_apply_cuti">Total Cuti</label>
                    <input class="form-control" id="tot_cuti" name="tot_cuti" readonly type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="tot_apply_cuti">Sisa Cuti</label>
                    <input class="form-control" id="remain_cuti" name="remain_cuti" readonly type="text" value="" required="">
                </div>
            </div>
            <div class="col pb-4">
                <h6>Keterangan Cuti <span class="text-danger">*</span></h6>
                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                    <textarea id="leave_reason" name="leave_reason" class="form-control" placeholder="Tulis alasan cuti anda disini" cols="30" rows="10"></textarea>
                    @error('leave_reason')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="pt-3">
                <button class="btn btn-primary submit_cuti" type="button">Submit Cuti</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
    {{-- Isi konten ketentuan pengambilan cuti  --}}
    <div class="col-xxl-6 col-lg-6">
        <div class="h5 pb-2 mb-4 text-danger border-bottom border-danger text-center">
            Perhatikan Ketentuan Sebelum Mengajukan Cuti
          </div>
        <ul class="list-unstyled">
            <h6><i class="fa fa-check-square" aria-hidden="true"></i> Karyawan wajib mengajukan izin cuti maksimal H-3 sebelum tanggal cuti yang diajukan.</h6>
            <h6><i class="fa fa-check-square" aria-hidden="true"></i> Jika mengajukan cuti tidak sesuai prosedur maka akan dihitung sebagai Cuti Non Prosedur.</h6>
            <h6><i class="fa fa-check-square" aria-hidden="true"></i> Berikut jenis cuti berdasarkan kesepakatan manajemen dan FSPMI :</h6>
            <ol>1. Cuti Tahunan : Hak cuti karyawan yang telah bekerja selama minimal 12 bulan tanpa terputus.</ol>
            <ol>2. Cuti Besar : Hak cuti karyawan dengan masa kerja 5 tahun berturut-turut dan kelipatannya.</ol>
            <ol>3. Cuti Khusus : Hak cuti yang diberikan kepada pekerja yang memiliki kepentingan mendesak atau kondisi tertentu sehingga mengharuskan untuk libur beberapa waktu.</ol>
        </ul>
    </div>
</div>
@section('script')
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function() {
    $("#from_date").datepicker({
        onSelect: function(){
            var check_nik =  $("#nik").val();
            if (check_nik == null || check_nik == ''){
                // alert('NIK Masih Kosong');
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Isi NIK Dulu yaaa'
                });
                    $("#from_date").val('');
                    $("#rf_id").focus();
            };
        }
    });

    $("#to_date").datepicker({
        onSelect: function(){
            var from    =   $("#from_date").val();
            var to      =   $("#to_date").val();
            var ttl_cuti = $('#tot_cuti').val();

            var dt1 = new Date(from);
            var dt2 = new Date(to);
            var tot_days = 0;
            var current_date = dt1;
            while (current_date <= dt2) {
                var day = current_date.getDay();
                if (day !== 0 && day !== 6) { // exclude weekends
                    tot_days++;
                }
                current_date.setDate(current_date.getDate() + 1);
            }
            var remain_cuti = (ttl_cuti - tot_days);
            $("#tot_apply_cuti").val(tot_days);
            $('#remain_cuti').val(remain_cuti);
        }
    });
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
                        $("#nama").val(data[0]["name"]);
                        $("#dept").val(data[0]["department"]);
                        $("#posisi").val(data[0]["position"]);
                        $('#tot_cuti').val(data[0]["ttl_cuti"]);
                        $("#leaves_type").focus();
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

    $(".submit_cuti").on("click", function() {
        $.ajax({
                url: "{{ route('epermit/formcuti/store') }}",
                type: "post",
                data: $("#form_cuti").serialize(),
                success: function(data){
                    Swal.fire({
                        icon: 'success',
                        title: 'Happy Holiday !!',
                        text: 'Cuti Kamu Berhasil Diajukan'
                    });
                    location.reload(true);

                },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal Submit Izin'
                    });
                }
            });

    });


    //Disable Weeekends
    (function($) {
        "use strict";
        var disabledDays = [0, 6];

        $('#from_date, #to_date').datepicker({
            language: 'en',
            onRenderCell: function (date, cellType) {
                if (cellType == 'day') {
                    var day = date.getDay(),
                        isDisabled = disabledDays.indexOf(day) != -1;
                    return {
                        disabled: isDisabled
                    }
                }
            }
        });
    })(jQuery);
</script>
@endsection
@endsection
