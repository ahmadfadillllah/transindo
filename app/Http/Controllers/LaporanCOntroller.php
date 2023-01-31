<?php

namespace App\Http\Controllers;

use App\Models\Tiket;
use Illuminate\Http\Request;

class LaporanCOntroller extends Controller
{
    //
    public function index()
    {
        $tiket = Tiket::all();
        return view('laporan.index', compact('tiket'));
    }

    public function update(Request $request, $id)
    {
        try {
            Tiket::where('id', $id)->update([
                'nama_lengkap' => $request->nama_lengkap,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'status' => $request->status,
            ]);
            return redirect()->route('laporan.index')->with('success', 'User berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->route('laporan.index')->with('info', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            Tiket::where('id', $id)->delete();

            return redirect()->route('laporan.index')->with('success', 'User berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('laporan.index')->with('info', $th->getMessage());
        }
    }
}
