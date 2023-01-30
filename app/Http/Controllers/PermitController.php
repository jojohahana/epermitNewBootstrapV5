<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LeavesUser;
use DateTime;

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
            'nik'           => 'required|string|min:4|max:4',
            'name'          => 'required|string',
            'dept'          => 'required|string',
            'posisi'        => 'required|string',
            'leaves_type'   => 'required|string|min:4|max:10',
            'from_date'     => 'required|string|max:50',
            'to_date'       => 'required|string|max:50',
            'reason'        => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $from_date = new DateTime($request->from_date);
            $to_date = new DateTime($request->to_date);
            $day = $from_date->diff($to_date);
            $day = $day->d;

            $leaves = new LeavesUser;
            $leaves->user_id = $request->user_id;
            $leaves->nama = $request->nama;
            $leaves->dept = $request->dept;
            $leaves->posisi = $request->posisi;
            $leaves->leaves_type = $request->leaves_type;
            $leaves->from_date = $request->from_date;
            $leaves->to_date = $request->to_date;
            $leaves->leave_reason = $request->leave_reason;
            $leaves->save();

            DB::commit();
            Swal.fire(
                'Cuti Berhasil Disimpan !',
                'Cuti telah disimpan',
                'success'
            );
            return redirect()->back();
        }catch(\Exception $e) {
            DB::rollback();
            Swal.fire(
                'Gagal !',
                'Gagal cuy',
                'success'
            );
            return redirect()->back();
        }
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
