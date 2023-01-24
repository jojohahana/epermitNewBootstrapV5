<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeavesUser;
use DB;
use DateTime;

class LeavesUserController extends Controller
{
    // public function indexCuti() {
    //     $leaves = DB::table('leaves_admins')
    //             ->join('users', 'users.user_id', '=', 'leaves_admins.user_id')
    //             ->select('leaves_admins.*', 'users.position', 'users.name')
    //             ->get();
    //     return view('forms.usercuti');
    // }


    public function saveCuti(Request $request) {
        $request->validate([
            'leave_type'    => 'required|string|max:255',
            'from_date'     => 'required|string|max:255',
            'to_date'       => 'required|string|max:255',
            'leave_reason'   => 'required|string|max:255',
        ]);
    }
}
