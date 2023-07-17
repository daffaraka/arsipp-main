<?php

namespace App\Http\Controllers\Admin;

use App\Models\Letter;

use App\Models\Department;
use App\Models\BatchRecord;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BatchTracking;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BatchRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $batch = BatchRecord::with('department', 'sender', 'tracking.user')->get();
        $departments = Department::all();
        return view('pages.admin.batch.index', compact('batch', 'departments'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('pages.admin.batch.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bets_no' => 'required',
            'bets_date' => 'required',
            'kode' => 'required',
            'department_id' => 'required',
        ]);

        $letter = BatchRecord::create([
            'bets_no' => $request->bets_no,
            'bets_date' => $request->bets_date,
            'produk_id' => $request->department_id,
            'kode' => $request->kode,
            'sender_id' => Auth::user()->id,
        ]);


        if ($letter) {
            BatchTracking::create(
                [
                    'batch_id' => $letter->id,
                    'user_id'  => Auth::user()->id,
                    'keterangan' => 'Admin telah mengaktifkan',
                    'status'   => 'Aktif',
                ]
            );
            return redirect()
                ->route('batch')
                ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
        } else {
            return redirect()
                ->route('batch')
                ->with('success', 'Terjadi kegagalan');
        }
    }


    public function show($id)
    {


        $item = BatchRecord::with('department', 'sender', 'tracking')->find($id);
        // dd($item);
        return view('pages.admin.batch.show', compact('item'));
    }


    public function edit($id)
    {
        $data['departments'] = Department::all();
        $data['item'] = BatchRecord::with('department', 'sender', 'tracking')->find($id);

        return view('pages.admin.batch.edit', $data);
    }

    public function update(Request $request, $id)
    {


        $batch = BatchRecord::find($id);


        $validatedData = $request->validate([
            'bets_no' => 'required',
            'bets_date' => 'required',
            'kode' => 'required',
            'department_id' => 'required',
        ]);
        $batch->update([
            'bets_no' => $request->bets_no,
            'bets_date' => $request->bets_date,
            'produk_id' => $request->department_id,
            'kode' => $request->kode,
            'sender_id' => Auth::user()->id,
        ]);

        return redirect()->route('batch');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BatchRecord  $batchRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = BatchRecord::find($id);
        $batch->delete();

        return redirect()->back();

    }
}
