@extends('layouts.navbar')
@section('title', 'Izin Cuti')
@section('title-content', 'FORM CUTI KARYAWAN')

@section('content')
<div class="row">
    {{-- Isi konten form  --}}
    <div class="col-xxl-6 col-lg-6">
        @csrf
        <form action="{{ url('epermit/formcuti/store')}}" method="POST">
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">NIK <span class="text-danger">*</span></label>
                    <input class="form-control" id="user_id" onkeyup="autofill()" autofocus type="text" placeholder="Enter NIK">
                    {{-- <input class="form-control" id="nik" onkeyup="getNik(this.value)" value="" @error('nik') is-invalid @enderror autofocus type="text" placeholder="Enter NIK"> --}}
                    {{-- @error(nik)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror --}}
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                    <input class="form-control" id="nama" type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Departemen</label>
                    <input class="form-control" id="dept"  type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Posisi</label>
                    <input class="form-control" id="posisi"  type="text" value="" required="">
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
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="form-group">
                        <label>To <span class="text-danger">*</span></label>
                        <input class="datepicker-here form-control digits" id="to_date" type="text" data-multiple-dates="3" data-multiple-dates-separator=", " data-language="en">
                    </div>
                </div>
            </div>
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Total Cuti Diambil</label>
                    <input class="form-control" id="validationCustom01" disabled="" type="text" value="" required="">
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Total Sisa Cuti</label>
                    <input class="form-control" id="validationCustom01" disabled="" type="text" value="" required="">
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="col pb-4">
                <h6>Keterangan Cuti <span class="text-danger">*</span></h6>
                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                    <textarea id="leave_reason" class="form-control" placeholder="Tulis alasan cuti anda disini" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="pt-3">
                <button class="btn btn-primary" type="submit">Submit Cuti</button>
                <button class="btn btn-danger" type="submit">Reset</button>
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
    function autofill() {
        var nik = $('#nik').val();
        $.ajax({
            url : 'test',
            data : 'nik='+nik,
        }).success(function(data){
            alert('okeeey')
        });
    }
</script>
@endsection
@endsection
