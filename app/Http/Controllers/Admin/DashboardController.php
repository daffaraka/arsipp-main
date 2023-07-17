<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BatchRecord;
use App\Models\BatchTracking;
use Illuminate\Http\Request;

use App\Models\Letter;

class DashboardController extends Controller
{
    public function index()
    {
        $masuk = Letter::count();
        $batch = BatchRecord::whereHas('tracking', function ($query) {
            $query->where('status', '!=', 'selesai')
                ->whereRaw('created_at = (SELECT MAX(created_at) FROM batch_trackings WHERE batch_id = batch_records.id)');
        })->count();


        return view('pages.admin.dashboard', [
            'masuk' => $masuk,
            'batch' => $batch,
        ]);
    }
}
