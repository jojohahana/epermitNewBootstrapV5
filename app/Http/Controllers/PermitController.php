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

    public function storeCuti(Request $request) {
        $request->validate([
            'nik'=> 'required|string|min:4|max:4',
            'name'   => 'required|string',
            'dept'   => 'required|string',
            'posisi'   => 'required|string',
            'type_cuti'   => 'required|string|min:4|max:10',
            'from_date'   => 'required|string|max:50',
            'to_date'   => 'required|string|max:50',
            'reason'   => 'required|string|max:100',
        ]);

        DB::beginTransaction();
    }

    public function indexSakit() {
        return view('forms.usersakit');
    }

    // public function indexCheck() {
    //     $check = DB::table('leaves_admins')
    // }
    public function indexCheck() {
        return view('forms.checkcuti');
    }

}
