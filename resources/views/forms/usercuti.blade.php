@extends('layouts.navbar')
@section('title', 'Izin Cuti')
@section('title-content', 'FORM CUTI KARYAWAN')

@section('content')
<div class="row">
    {{-- Isi konten form  --}}
    <div class="col-xxl-6 col-lg-6">
        <form onsubmit="return false" action="{{ route('epermit/formcuti/store') }}" method="POST">
            @csrf
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">NIK <span class="text-danger">*</span></label>
                    <input class="form-control" id="nik" autofocus type="text" placeholder="Enter NIK">
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
                <select class="js-example-basic-single col-sm-12" id="leaves_type">
                    <option selected disabled>Pilih Jenis Cuti</option>
                    {{-- <optgroup label="Cuti"></optgroup> --}}
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
                        <input class="datepicker-here form-control digits" id="from_date" type="text" data-multiple-dates="3" data-multiple-dates-separator=", " data-language="en">
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
                        <input class="datepicker-here form-control digits" id="to_date" type="text" data-multiple-dates="3" data-multiple-dates-separator=", " data-language="en">
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
                    <label class="form-label" for="validationCustom01">Total Cuti Diambil</label>
                    <input class="form-control" id="validationCustom01" disabled="" type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Total Sisa Cuti</label>
                    <input class="form-control" id="validationCustom01" disabled="" type="text" value="" required="">
                </div>
            </div>
            <div class="col pb-4">
                <h6>Keterangan Cuti <span class="text-danger">*</span></h6>
                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                    <textarea id="leave_reason" class="form-control" placeholder="Tulis alasan cuti anda disini" cols="30" rows="10"></textarea>
                    @error('leave_reason')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
                </div>
            </div>
            <div class="pt-3">
                <button class="btn btn-primary" type="submit">Submit Cuti</button>
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
            <li><h6>Cuti Tahunan    : <span>Hak cuti karyawan yang telah bekerja selama minimal 12 bulan tanpa terputus.</span></h6></li>
            <li><h6>Cuti Besar      : <span>Hak cuti karyawan dengan masa kerja 5 tahun berturut-turut dan kelipatannya.</span></h6></li>
            <li><h6>Cuti Khusus     : <span>Hak cuti karyawan dengan masa kerja 5 tahun berturut-turut dan kelipatannya.</span></h6></li>
        </ul>
    </div>
</div>
@section('script')
<script>
    $(document).on('keypress', '#nik', function (e){
        let val_nik = $(this).val();
        let post_url = "{{ route('epermit/getemployee', ':id') }}";
        post_url = post_url.replace(':id', val_nik);
        if (e.keyCode == 13){
            $.ajax({
                url: post_url,
                type: 'get',
                dataType: 'json',
                success: function(data){
                    $('#nik').val(data[0]['employee_id']);
                    $('#nama').val(data[0]['name']);
                    $('#dept').val(data[0]['department']);
                    $('#posisi').val(data[0]['position']);
                    $('#leaves_type').focus();
                }
            });
        }
    });


</script>
@endsection
@endsection
