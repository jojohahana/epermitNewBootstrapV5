<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\leaves_admins;
use App\Models\SickLeaves;
// use App\Models\Karyawan;
use DateTime;
use DB;
use Carbon\Carbon;

class PermitController extends Controller
{
    public function dashEpermit() {
        return view('maindash');
    }

    public function indexCuti() {
        return view('forms.usercuti');
    }

    // GENERATE NIK DATA KARYAWAN
    public function get_employee($nik){
        if (!empty($nik)) {
            $employee = DB::table('employee')
            ->where('data_status', '=','ACTIVE')
            ->where('rfid_tag','=',$nik)
            ->get();

            echo json_encode($employee);
            exit;
    }else{
        return response()->json(['errors' => true]);
    }

    }

    // SAVE DATA IZIN CUTI
    public function storeCuti(Request $request) {
        // DB::beginTransaction();

        $request->validate([
            'nik'                   => 'required|string|min:4|max:4',
            // 'nama'               => 'required|string|max:50',
            // 'dept'               => 'required|string|max:50',
            // 'posisi'             => 'required|string|max:50',
            'leaves_type'           => 'required|string|max:50',
            'from_date'             => 'required|string|max:50',
            'to_date'               => 'required|string|max:50',
            'leave_reason'          => 'required|string|max:100',
            'tot_apply_cuti'        => 'required|string|max:50'
         //    'sisaCuti'           => 'required|string|max:50',
         ]);

        $cuti = leaves_admins::where('user_id','='.$request->employee_id)->first();
        if ($cuti === null) {
            $cuti = new leaves_admins;
            $cuti->user_id      = $request->nik;
            $cuti->leave_type   = $request->leaves_type;
            $fromdate           = $request->from_date;
            $cuti->from_date    = Carbon::parse($fromdate)->format('Y-m-d');
            $todate             = $request->to_date;
            $cuti->to_date      = Carbon::parse($todate)->format('Y-m-d');
            $cuti->leave_reason = $request->leave_reason;
            $cuti->day          = $request->tot_apply_cuti;
            // $cuti->user_id      = $request->employee_id;
            // $cuti->user_id      = $request->employee_id;
            $cuti->save();

              // DB::commit();
            return response()->json(['success' => true]);
            return redirect()->route('epermit/formcuti');
        } else {
            // DB::rollback();
            return response()->json(['errors' => true]);
            return redirect()->back();
        }
    }

    public function indexSakit() {
        return view('forms.usersakit');
    }

    // SAVE DATA IZIN SAKIT

    public function storeSakit(Request $request) {
        $request->validate([
            'nik'               => 'required|string|min:4|max:4',
            'from_date'         => 'required|string|max:50',
            'to_date'           => 'required|string|max:50',
            'sick_type'         => 'required|string|max:50',
            'tot_apply_sick'    => 'required|string|max:50'
        ]);

        $sakit = leaves_sick::where('user_id','=',$request->employee_id)->first();
        if ($sakit === null) {
            $sakit = new leaves_sick;
            $sakit->user_id     = $request->nik;
            $fromdate           = $request->from_date;
            $sakit->from_date   = Carbon::parse($fromdate)->format('Y-m-d');
            $todate             = $request->to_date;
            $sakit->to_date     = Carbon::parse($todate)->format('Y-m-d');
            $sakit->sick_type   = $request->sick_type;
            $sakit->day         = $request->tot_apply_sick;
            $sakit->save();

            return response()->json(['success' => true]);
            return redirect()->route('epermit/formsakit');
        } else {
            return response()->json(['errors' => true]);
            return redirect()->back();
        }
    }


    public function indexCheck() {
        return view('forms.checkcuti');
    }

    public function checkCuti(Request $request) {
        // $reqCheck = DB::table('leaves_admin')
        //         ->join('employee','leaves_admin.user_id','=','employee.employee_id')
        //         ->select('leaves_admin.user_id',
        //                 'employee.name',
        //                 'employee.department',
        //                 'leaves_admin.leave_type',
        //                 'leaves_admin.day',
        //                 'leaves_admin.reason',
        //                 'leaves_admin.updated_at',
        //                 'leaves_admin.data_status'
        //                 )
        //         ->where('data_status','=','ACTIVE')
        //         ->get();

        if($request->employee_id) {
            $reqCheck = DB::table('leaves_admin')
                ->join('employee','leaves_admin.user_id','=','employee.employee_id')
                ->select('leaves_admin.user_id',
                        'employee.name',
                        'employee.department',
                        'leaves_admin.leave_type',
                        'leaves_admin.day',
                        'leaves_admin.reason',
                        'leaves_admin.updated_at',
                        'leaves_admin.data_status'
                        )
                ->where('employee_id','LIKE','%'.$request->employee_id.'%')
                ->get();
        }
        return Datatables::of($reqCheck);
    }


}
