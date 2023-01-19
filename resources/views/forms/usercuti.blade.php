@extends('layouts.navbar')
@section('title', 'Leave')
@section('title-content', 'FORM LEAVE')

@section('content')
<form class="needs-validation" novalidate="">
    <div class="row g-3">
        <div class="col-md-3">
            <label class="form-label" for="validationCustom01">First name</label>
            <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">
            <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="validationCustom01">First name</label>
            <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">
            <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="validationCustom01">First name</label>
            <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">
            <div class="valid-feedback">Looks good!</div>
        </div>
        <div class="col-md-3">
            <label class="form-label" for="validationCustom01">First name</label>
            <input class="form-control" id="validationCustom01" type="text" value="Mark" required="">
            <div class="valid-feedback">Looks good!</div>
        </div>
    </div>

                      <div class="mb-3">
                        <div class="form-check">
                          <div class="checkbox p-0">
                            <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                            <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                          </div>
                          <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                      </div>
                      <button class="btn btn-primary" type="submit">Submit form</button>
</form>
@endsection
