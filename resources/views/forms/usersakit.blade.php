@extends('layouts.navbar')
@section('title', 'Izin Sakit')
@section('title-content', 'FORM SAKIT KARYAWAN')

@section('content')
<div class="row">
    {{-- Isi konten form  --}}
    <div class="col-xxl-6 col-lg-6">
        <form id="form_sakit" method="post">
            @csrf
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">NIK <span class="text-danger">*</span></label>
                    <input class="form-control" id="rf_id" name="rf_id" autofocus type="text" autofocus placeholder="Masukkan NIK Anda">
                    <input class="form-control" id="nik" name="nik" type="hidden" value="">
                    @error('nik')
                        <div class="alert alert-danger mt-2">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                    <input class="form-control" id="nama" readonly type="text" value="" required="" disabled="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Departemen</label>
                    <input class="form-control" id="dept" readonly type="text" value="" required="" disabled="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Posisi</label>
                    <input class="form-control" id="posisi" readonly type="text" value="" required="" disabled="">
                </div>
            </div>
            <div class="row date-picker">
                <h6>Tanggal Izin Sakit</h6>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>From <span class="text-danger">*</span></label>
                        <input class="datepicker-here form-control digits from_date" id="from_date" name="from_date" type="text" data-language="en">
                        @error('from_date')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>To <span class="text-danger">*</span></label>
                        <input class="datepicker-here form-control digits to_date" id="to_date" name="to_date" type="text" data-language="en">
                    </div>
                </div>
            </div>
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="tot_apply_sick">Lama Izin Sakit</label>
                    <input class="form-control" id="tot_apply_sick" name="tot_apply_sick" readonly type="text" value="" required="">
                </div>
            </div>
            <div class="col pb-4">
                <h6>Status Rawat <span class="text-danger">*</span></h6>
                <select class="js-example-basic-single col-sm-12" id="sick_type" name="sick_type">
                    <option selected disabled>Pilih Jenis Rawat</option>
                        <option value="RJalan">Rawat Jalan</option>
                        <option value="RInap">Rawat Inap</option>
                </select>
            </div>

            {{-- Lampiran Surat  --}}
            {{-- <div class="row g-3 pb-4">
                <h6>Upload File <span class="text-danger">*</span></h6>
                <div class="mb-3">
                    <input type="file" class="form-control" aria-label="file example" required>
                    <div id="#" class="form-text">
                     Lampirkan Surat Keterangan Dokter atau Surat Rawat Inap
                    </div>
                </div>
            </div> --}}
            <div class="pt-3">
                <button class="btn btn-primary submit_sakit" type="button">Submit Izin Sakit</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
    {{-- Isi konten ketentuan pengambilan cuti  --}}
    <div class="col-xxl-6 col-lg-6">
        <div class="h5 pb-2 mb-4 text-danger border-bottom border-danger text-center">
            Perhatikan Ketentuan Sebelum Mengajukan Izin Sakit
          </div>
        <ul class="list-unstyled">
            <h6><i class="fa fa-check-square" aria-hidden="true"></i> Karyawan wajib mengajukan izin sakit maksimal H+2 setelah masuk kerja.</h6>
            <h6><i class="fa fa-check-square" aria-hidden="true"></i> Karyawan wajib melampirkan Surat Keterangan Dokter fakses BPJS untuk Rawat Jalan</h6>
            <h6><i class="fa fa-check-square" aria-hidden="true"></i> Karyawan wajib melampirkan Surat Keterangan Rawat Inap dari klinik atau RS fakses BPJS.</h6>

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
                alert('NIK Masih Kosong');
                    $("#from_date").val('');
                    $("#rf_id").focus();
            };
        }
    });

    $("#to_date").datepicker({
        onSelect: function(){
            var from    =   $("#from_date").val();
            var to      =   $("#to_date").val();

            var dt1 = new Date(from);
            var dt2 = new Date(to);
            var tot_time = dt2.getTime() - dt1.getTime();
            var tot_days = (tot_time / (1000 * 3600 * 24))+1;
            $("#tot_apply_sick").val(tot_days);
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
                        $("#sick_type").focus();
                    }
                },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Input NIK Terlebih dahulu'
                        });
                }
            });
        }
    });

    $(".submit_sakit").on("click", function() {
        $.ajax({
                url: "{{ route('epermit/formsakit/store') }}",
                type: "post",
                data: $("#form_sakit").serialize(),
                success: function(data){
                    Swal.fire({
                        icon: 'success',
                        title: 'Yeaayy !!',
                        text: 'Izin Sakit Kamu Berhasil Diajukan'
                    });
                    // alert("Success Add Data");
                    location.reload(true);

                },error: function(data){
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Gagal Submit Izin'
                    });
                    // alert("Gagal Add Data")
                }
            });

    });
</script>
@endsection
@endsection
