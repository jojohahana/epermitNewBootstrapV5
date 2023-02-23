<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\leaves_admins;
use App\Models\leaves_sick;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;
use Carbon\Carbon;
use DateTime;
use DB;
use Datatables;

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
            'leaves_type'           => 'required|string|max:50',
            'from_date'             => 'required|string|max:50',
            'to_date'               => 'required|string|max:50',
            'leave_reason'          => 'required|string|max:100',
            'tot_apply_cuti'        => 'required|string|max:50'
         //    'sisaCuti'           => 'required|string|max:50',
         ]);

        // Push telegram notif here
        $text = "<b>📢  New Permit Submitted !!  📢</b>\n\n"
                . "<b>💁 NIK Karyawan: </b>"
                . "$request->nik\n"
                . "<b>👉 Jenis Izin: </b>"
                . "$request->leaves_type\n"
                . "<b>📅 Tanggal Izin: \n</b>"
                . "       $request->from_date  -  "
                . "$request->to_date \n"
                . "<b>🌟 Lama Izin: </b>"
                . "$request->tot_apply_cuti hari\n"
                . "<b>📰 Ket Izin: </b>"
                . $request->leave_reason;
         Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001883164282'),
            'parse_mode' => 'HTML',
            'text' => $text
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

    public function updatedActivity() {
        return view('message');
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

        // Push telegram notif here
        $text = "<b>📢  New Permit Submitted !!  📢</b>\n\n"
                . "<b>💁 NIK Karyawan: </b>"
                . "$request->nik\n"
                . "<b>👉 Jenis Izin: </b>"
                . "$request->sick_type\n"
                . "<b>📅 Tanggal Izin: \n</b>"
                . "       $request->from_date  -  "
                . "$request->to_date \n"
                . "<b>🌟 Lama Izin: </b>"
                . "$request->tot_apply_sick hari\n";
                // . "<b>📰 Ket Izin: </b>"
                // . $request->leave_reason;
         Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001883164282'),
            'parse_mode' => 'HTML',
            'text' => $text
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

    // ++ Check Izin menampilkan status izin hanya smpai approval 1
    public function checkCuti($id) {
            $reqCheck = DB::table('leaves_admin')
                ->join('employee','leaves_admin.user_id','=','employee.employee_id')
                ->select('leaves_admin.user_id',
                        'employee.name',
                        'employee.department',
                        'leaves_admin.leave_type',
                        'leaves_admin.day',
                        'leaves_admin.leave_reason',
                        'leaves_admin.updated_at',
                        'leaves_admin.data_status'
                        )
                ->where('employee_id','=',$id)
                ->where('leaves_admin.data_status','=','ACTIVE')
                ->where('leaves_admin.stat_app2','=','Approve')
                ->where('leaves_admin.stat_app3','=','Wait')
                ->get();
            $output = [
                'dataIzin' => $reqCheck
            ];
            return response()->json($output);
    }


    // +++++ INDEX CHECK SAKIT +++++
    public function indexCheckSakit() {
        return view('forms.checkSakit');
    }

    // +++++ GET DATA SAKIT BY EMP ID +++++
    public function checkSakit($id) {
        $reqCheck = DB::table('leaves_sick')
            ->join('employee','leaves_sick.user_id','=','employee.employee_id')
            ->select('leaves_sick.user_id',
                    'employee.name',
                    'employee.department',
                    'leaves_sick.sick_type',
                    'leaves_sick.day',
                    'leaves_sick.updated_at',
                    'leaves_sick.data_status'
                    )
            ->where('employee_id','=',$id)
            ->where('leaves_sick.data_status','=','ACTIVE')
            // ->where('leaves_sick.stat_app2','=','Approve')
            // ->where('leaves_sick.stat_app3','=','Wait')
            ->get();
        $output = [
            'dataSakit' => $reqCheck
        ];
        return response()->json($output);
}

}
