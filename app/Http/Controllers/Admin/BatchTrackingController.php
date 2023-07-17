<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\BatchTracking;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BatchTrackingController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {


        $keterangan = $request->keterangan ?? '-';
        $status = [];
        switch ($request->status) {
            case ('penimbangan'):
                $status = 'Penimbangan';
                break;
            case ('pengolahan'):
                $status = 'Pengolahan';
                break;
            case ('rekonsiliasi'):
                $status = 'Rekonsiliasi';
                break;
            case ('container'):
                $status = 'Container';
                break;
            case ('pengisian'):
                $status = 'Pengisian';
                break;
            case ('pengemasan'):
                $status = 'Pengemasan';
                break;
            case ('selesai'):
                $status = 'Selesai';
                break;
        }

        BatchTracking::create(
            [
                'batch_id' => $request->batch_id,
                'user_id'  => Auth::user()->id,
                'keterangan' => $keterangan,
                'status'   => $status,
            ]
        );
        return redirect()
            ->back()
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function show(BatchTracking $batchTracking)
    {
        //
    }


    public function edit(BatchTracking $batchTracking)
    {
        //
    }

    public function update(Request $request, BatchTracking $batchTracking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BatchTracking  $batchTracking
     * @return \Illuminate\Http\Response
     */
    public function destroy(BatchTracking $batchTracking)
    {
        //
    }
}
