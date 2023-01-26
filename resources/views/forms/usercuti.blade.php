@extends('layouts.navbar')
@section('title', 'Izin Cuti')
@section('title-content', 'FORM CUTI KARYAWAN')

@section('content')
<div class="row">
    {{-- Isi konten form  --}}
    <div class="col-xxl-6 col-lg-6">
        <form action="" class="needs-validation" novalidate="">
            <div class="row g-3 pb-4">
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">NIK <span class="text-danger">*</span></label>
                    <input class="form-control" id="nik" onkeyup="getNik(this.value)" value="" type="text" placeholder="Enter NIK">
                    <div class="valid-feedback">Looks good!</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Nama Karyawan</label>
                    <input class="form-control" id="nama" disabled="" type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Departemen</label>
                    <input class="form-control" id="dept" disabled="" type="text" value="" required="">
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="validationCustom01">Posisi</label>
                    <input class="form-control" id="posisi" disabled="" type="text" value="" required="">
                    <div class="valid-feedback">Looks good!</div>
                </div>
            </div>
            <div class="col pb-4">
                <h6>Jenis Cuti <span class="text-danger">*</span></h6>
                <select class="js-example-basic-single col-sm-12" id="leaves_type">
                    <optgroup label="Cuti"></optgroup>
                        <option value="CT">Tahunan</option>
                        <option value="CB">Besar</option>
                        <option value="CK">Khusus</option>
                </select>
            </div>

            <div class="row date-range-picker">
                <h6>Tanggal Cuti <span class="text-danger">*</span></h6>
                <div class="col-xl-6">
                    {{-- <div class="daterange-card"> --}}
                        <div class="theme-form">
                            <div class="form-group">
                              <input class="form-control digits" type="text" name="daterange" value="01/15/2017 - 02/15/2017">
                            </div>
                        </div>
                    {{-- </div> --}}
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
                <h6>Keterangan Cuti</h6>
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
        <h6>Perhatikan Sebelum Mengajukan Izin Cuti</h6>
        <ul class="list-unstyled">
            <li><h6>Ini belum muncul bullett nya</h6></li>
            <ul>
                <li>Ketentuan pertama</li>
            </ul>
        </ul>
    </div>
</div>
@section('script')
<script>
    function getNik(str) {
        if (str.length == 0) {
            document.getElementbyId("nama").value = "";
            document.getElementbyId("dept").value = "";
            document.getElementbyId("posisi").value = "";
            return
        } else {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {

            }
        }
    }
</script>
{{-- <script>
    $('#nik').on('change',function() {
        $('#nama').val($(this).find(':selected').data('nik'));
        $('#dept').val($(this).find(':selected').data('dept'));
        $('#posisi').val($(this).find(':selected').data('posisi'));
    });
</script> --}}
{{-- <script type="text/javascript">
    $('#nik').on('keyup',function(){
        var nik = $('#nik').val();
        $.ajax({
            url:"{{ url('formcuti/getusers') }}"+/nik,
            data:"nik="+nik,
            success:function(data) {
                var json= data;
                let obj = JSON.parse(json);
                $('#nama').val(obj.nama);
                $('#dept').val(obj.dept);
                $('#posisi').val(obj.posisi);
                console.log(obj);
            }
        });
    });

    function isi_otomatis(){
        var nik = $('#nik').val();
        $.ajax{(
            url:"{{ url('formcuti/getusers') }}"+/nik,
            data:"nik="+nik,
            success:function(data) {
                var json= data;
                let obj = JSON.parse(json);
                $('#nama').val(obj.nama);
                $('#dept').val(obj.dept);
                $('#posisi').val(obj.posisi);
                console.log(obj);
            }
        )};
    }
</script> --}}
@endsection
@endsection
