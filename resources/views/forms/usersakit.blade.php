@extends('layouts.navbar')
@section('title', 'Izin Sakit')
@section('title-content', 'FORM SAKIT KARYAWAN')

@section('content')
<div class="row">
    {{-- Isi konten form  --}}
    <div class="col-xxl-6 col-lg-6">
        <form class="needs-validation" novalidate="">
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">NIK</label>
                    <input class="form-control" id="validationCustom01" type="text" value="" required="">
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                    <input class="form-control" id="validationCustom01" type="text" value="" required="" disabled="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Departemen</label>
                    <input class="form-control" id="validationCustom01" type="text" value="" required="" disabled="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Posisi</label>
                    <input class="form-control" id="validationCustom01" type="text" value="" required="" disabled="">
                </div>
            </div>
            {{-- <div class="col pb-4">
                <h6>Jenis Cuti</h6>
                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                  <div class="radio radio-primary">
                    <input id="radioinline1" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline1">Cuti Tahunan</label>
                  </div>
                  <div class="radio radio-primary">
                    <input id="radioinline2" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline2">Cuti Besar</label>
                  </div>
                  <div class="radio radio-primary">
                    <input id="radioinline3" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline3">Cuti Khusus</label>
                  </div>
                </div>
            </div> --}}
            <div class="row date-range-picker">
                <h6>Tanggal Izin</h6>
                <div class="col-xl-6">
                        <div class="theme-form">
                            <div class="form-group">
                                <input type="text" class="form-control digits" name="daterange" value="01/01/2023">
                            </div>
                        </div>
                </div>
            </div>
            <div class="col pb-4">
                <h6>Status Rawat</h6>
                <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                  <div class="radio radio-primary">
                    <input id="radioinline1" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline1">Rawat Jalan</label>
                  </div>
                  <div class="radio radio-primary">
                    <input id="radioinline2" type="radio" name="radio1" value="option1">
                    <label class="mb-0" for="radioinline2">Rawat Inap</label>
                  </div>
                </div>
            </div>

            <div class="row g-3 pb-4">
                <h6>Upload File</h6>
                <div class="mb-3">
                    <input type="file" class="form-control" aria-label="file example" required>
                    <div id="#" class="form-text">
                     Lampirkan Surat Keterangan Dokter atau Surat Rawat Inap
                    </div>
                </div>
            </div>
            <div class="pt-3">
                <button class="btn btn-primary" type="submit">Submit Izin Sakit</button>
                <button class="btn btn-danger" type="submit">Reset</button>
            </div>
        </form>
    </div>
    {{-- Isi konten ketentuan pengambilan cuti  --}}
    <div class="col-xxl-6 col-lg-6">
        <h6>Perhatikan Sebelum Mengajukan Izin Cuti</h6>
        <ul class="list-unstyled">
            <li><h6>Ini belum muncul bullett nya</h6></li>
            <ul>
                <li>Ketentuan pertama</li>
            </ul>
        </ul>
    </div>
</div>
@endsection
