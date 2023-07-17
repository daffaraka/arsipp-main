<?php

namespace App\Http\Controllers\Admin;

use App\Models\Letter;
use App\Models\Sender;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LetterController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $departments = Department::all();
        $senders = Sender::all();

        return view('pages.admin.letter.create', [
            'departments' => $departments,
            'senders' => $senders,
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'bets_no' => 'required',
            'bets_date' => 'required',
            'bets_received' => 'required',
            'kode' => 'required',
            'department_id' => 'required',
            'bets_file' => 'required|mimes:pdf|file',
        ]);

        $file = $request->file('bets_file');
        $filename = $file->getClientOriginalName();
        $fileExt = $file->getClientOriginalExtension();
        $path = 'Bets-File';
        $fileSave = $request->bets_no.'-'.time().'-'.$filename;
        $file->move($path, $fileSave);

        Letter::create([
            'bets_no' => $request->bets_no,
            'bets_date' => $request->bets_date,
            'bets_received' => $request->bets_received,
            'department_id' => $request->department_id,
            'kode' => $request->kode,
            'sender_id' => Auth::user()->id,
            'bets_file' =>  $fileSave,
        ]);

        return redirect()
            ->route('arsip')
            ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function incoming_mail()
    {            $data = Letter::with(['department', 'sender'])->latest()->get();

        // if (request()->ajax()) {

        //     return Datatables::of($query)
        //         ->addColumn('action', function ($item) {
        //             return '
        //                 <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
        //                     <i class="fa fa-search-plus"></i> &nbsp; Detail
        //                 </a>
        //                 <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
        //                     <i class="fas fa-edit"></i> &nbsp; Ubah
        //                 </a>
        //                 <form  method="POST" >
        //                     ' . method_field('delete') . csrf_field() . '
        //                     <button class="btn btn-danger btn-xs">
        //                         <i class="far fa-trash-alt"></i> &nbsp; Hapus
        //                     </button>
        //                 </form>
        //             ';
        //         })
        //         ->editColumn('post_status', function ($item) {
        //             return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">' . $item->post_status . '</div>' : '<div class="badge bg-gray-200 text-dark">' . $item->post_status . '</div>';
        //         })
        //         ->addIndexColumn()
        //         ->removeColumn('id')
        //         ->rawColumns(['action', 'post_status'])
        //         ->make();
        // }

        return view('pages.admin.letter.index',compact('data'));
    }

    // public function outgoing_mail()
    // {
    //     if (request()->ajax()) {
    //         $query = Letter::with(['department', 'sender'])->where('letter_type', 'Surat Keluar')->latest()->get();

    //         return Datatables::of($query)
    //             ->addColumn('action', function ($item) {
    //                 return '
    //                     <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
    //                         <i class="fa fa-search-plus"></i> &nbsp; Detail
    //                     </a>
    //                     <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
    //                         <i class="fas fa-edit"></i> &nbsp; Ubah
    //                     </a>
    //                     <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm(' . "'Anda akan menghapus item ini dari situs anda?'" . ')">
    //                         ' . method_field('delete') . csrf_field() . '
    //                         <button class="btn btn-danger btn-xs">
    //                             <i class="far fa-trash-alt"></i> &nbsp; Hapus
    //                         </button>
    //                     </form>
    //                 ';
    //             })
    //             ->editColumn('post_status', function ($item) {
    //                 return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">' . $item->post_status . '</div>' : '<div class="badge bg-gray-200 text-dark">' . $item->post_status . '</div>';
    //             })
    //             ->addIndexColumn()
    //             ->removeColumn('id')
    //             ->rawColumns(['action', 'post_status'])
    //             ->make();
    //     }

    //     return view('pages.admin.letter.outgoing');
    // }

    public function show($id)
    {
        $item = Letter::with(['department', 'sender'])->findOrFail($id);

        return view('pages.admin.letter.show', [
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $item = Letter::with('department')->findOrFail($id);


        $departments = Department::all();
        $senders = Sender::all();

        return view('pages.admin.letter.edit', [
            'departments' => $departments,
            'senders' => $senders,
            'item' => $item,
        ]);
    }

    public function download_letter($id)
    {
        $item = Letter::findOrFail($id);
        $filePath = public_path('Bets-File/'.$item->bets_file);

        return Response::download($filePath);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'bets_no' => 'required',
            'bets_date' => 'required',
            'bets_received' => 'required',
            'kode' => 'required',
            'department_id' => 'required',
            'bets_file' => 'required|mimes:pdf|file',
        ]);

        $item = Letter::findOrFail($id);

        $item = Letter::findOrFail($id);

        if ($request->hasFile('bets_file')) {
            $file = $request->file('bets_file');
            $filename = $file->getClientOriginalName();
            $fileSave = $request->bets_no . '-' . time() . '-' . $filename;
            $file->move('Bets-File', $fileSave);
            Storage::delete($item->bets_file);
            $validatedData['bets_file'] = $fileSave;
        }

        $item->update($validatedData);

        return redirect()
            ->route('arsip')
            ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Letter::findorFail($id);



        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
            ->route('arsip')
            ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
