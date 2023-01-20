<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermitController extends Controller
{
    public function dashEpermit() {
        return view('maindash');
    }

    public function indexCuti() {
        return view('forms.usercuti');
    }

    public function indexSakit() {
        return view('forms.usersakit');
    }

    public function indexCheck() {
        return view('forms.checkcuti');
    }
}
