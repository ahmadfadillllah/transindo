<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index()
    {
        return view('dashboard.index');
    }

    public function update_qrcode(Request $request)
    {
            $tiket_user = Tiket::where('id_tiket', $request->id_tiket)->first();
            if($tiket_user->status == 'Sudah Terpakai'){
                return json_encode([
                    'status' => 'warning',
                    'kode' => 500,
                    'message' => 'Error'
                ]);
            }else{
                Tiket::where('id_tiket', $request->id_tiket)->update(['status' => 'Sudah Terpakai']);

                return json_encode([
                    'status' => 'success',
                    'kode' => 200,
                    'dataUpdate' => Tiket::where('id_tiket', $request->id_tiket)->first()
                ]);
            }

    }

    public function update_idtiket(Request $request)
    {
        $tiket_user = Tiket::where('id_tiket', $request->id_tiket)->first();
        if($tiket_user->status == 'Sudah Terpakai'){
            return redirect()->back()->with('tiket_info', 'Maaf tiket sudah pernah digunakan sebelumnya');
        }else{
            Tiket::where('id_tiket', $request->id_tiket)->update(['status' => 'Sudah Terpakai']);

            return redirect()->back()->with('tiket_success', 'Hai '.$tiket_user->nama_lengkap. ', silahkan masuk ke room');
        }
    }
}
