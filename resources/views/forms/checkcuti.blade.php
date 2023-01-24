@extends('layouts.navbar')
@section('title', 'Check Izin')
@section('title-content', 'FORM CHECK IZIN CUTI & SAKIT')

@section('content')
<form class="needs-validation" novalidate="">
    <div class="col pb-4">
        <h6>Pilih Kategori Izin</h6>
        <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
          <div class="radio radio-primary">
            <input id="radioinline1" type="radio" name="radio1" value="option1">
            <label class="mb-0" for="radioinline1">Izin Cuti</label>
          </div>
          <div class="radio radio-primary">
            <input id="radioinline2" type="radio" name="radio1" value="option1">
            <label class="mb-0" for="radioinline2">Izin Sakit</label>
          </div>
          <div class="col-md-3 pt-3">
            <h6>NIK</h6>
            {{-- <label class="form-label" for="validationCustom01">NIK</label> --}}
            <input class="form-control" id="validationCustom01" type="text" value="" required="" placeholder="Masukkan NIK Anda">
            <div class="valid-feedback">Looks good!</div>
          </div>
        </div>
    </div>
    <div class="pt-3 pb-6">
        <button class="btn btn-primary" type="submit">CHECK IZIN</button>
        <button class="btn btn-danger" type="submit">RESET</button>
    </div>
</form>

{{-- Datatable Start  --}}
<div class="card-header pt-5">
    <h5>Progress Izin</h5><span>Data yang tampil adalah data izin yang sudah disubmit.</span>
  </div>
  <div class="table-responsive">
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NIK</th>
          <th scope="col">Nama</th>
          <th scope="col">Dept</th>
          <th scope="col">Jenis Izin</th>
          <th scope="col">Tanggal Izin</th>
          <th scope="col">Status</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Alexander</td>
          <td>Orton</td>
          <td>@mdorton</td>
          <td>Admin</td>
          <td>Admin</td>
          <td>USA</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Alexander</td>
          <td>Orton</td>
          <td>@mdorton</td>
          <td>Admin</td>
          <td>Admin</td>
          <td>USA</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td>Alexander</td>
          <td>Orton</td>
          <td>@mdorton</td>
          <td>Admin</td>
          <td>Admin</td>
          <td>USA</td>
        </tr>
        <tr>
          <th scope="row">4</th>
          <td>Alexander</td>
          <td>Orton</td>
          <td>@mdorton</td>
          <td>Admin</td>
          <td>Admin</td>
          <td>USA</td>
        </tr>
      </tbody>
    </table>
  </div>

@endsection
