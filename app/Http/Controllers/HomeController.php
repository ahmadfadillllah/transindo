<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    //
    public function index()
    {
        \Midtrans\Config::$serverKey = 'SB-Mid-server-5aQABsAA0KihdYoBHSk1kgPy';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 50000,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return view('auth.register', compact('snapToken'));
    }

    public function register_post(Request $request)
    {
        $date = date('YmdHisgis');

        try {
            $tiket = new Tiket;

            $tiket->id_tiket = rand(1000000, 9999999);
            $tiket->nama_lengkap = $request->nama_lengkap;
            $tiket->email = $request->email;
            $tiket->no_hp = $request->no_hp;
            $tiket->status = 'Belum Terpakai';
            $tiket->qrcode = $date.'qrcode.svg';

            $tiket->save();

            QrCode::generate($tiket->id_tiket, public_path('/admin/dompet.dexignlab.com/xhtml/images/qrcode/').$date.'qrcode.svg');

            return json_encode([
                'status' => 'success',
                'kode' => 200,
                'dataPemesanan' => $tiket
            ]);
        } catch (\Throwable $th) {
            return json_encode([
                'status' => 'success',
                'kode' => 500,
                'message' => 'Data tidak dapat dipost'
            ]);
        }
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_post(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'email' => 'Email tidak ditemukan',
            'password' => 'Password salah',
        ])->onlyInput('email', 'password');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
