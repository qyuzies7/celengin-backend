<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    // List transaksi user login + saldo
    public function index(Request $request)
    {
        $pengguna = $request->user();
        $transaksi = Transaksi::where('pengguna_id', $pengguna->id)
            ->with(['income', 'outcome'])
            ->orderByDesc('tanggal')
            ->get();

        $saldo = Transaksi::where('pengguna_id', $pengguna->id)
            ->sum(\DB::raw("CASE jenis WHEN 'income' THEN nominal ELSE -nominal END"));

        return response()->json([
            'transaksi' => $transaksi,
            'saldo' => $saldo,
        ]);
    }

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $pengguna = $request->user();

        $data = $request->validate([
            'jenis' => 'required|in:income,outcome',
            'nominal' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'income_id' => 'nullable|exists:incomes,id',
            'outcome_id' => 'nullable|exists:outcomes,id',
            'tanggal' => 'nullable|date',
        ]);

        $data['pengguna_id'] = $pengguna->id;
        $data['tanggal'] = $data['tanggal'] ?? now();

        // Hanya simpan satu ID berdasarkan jenis
        if ($data['jenis'] === 'income') {
            $data['income_id'] = $data['income_id'];
            unset($data['outcome_id']);
        } else {
            $data['outcome_id'] = $data['outcome_id'];
            unset($data['income_id']);
        }
        
        $trx = Transaksi::create($data);

        return response()->json($trx, 201);
    }
}