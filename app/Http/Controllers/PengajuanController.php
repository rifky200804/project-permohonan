<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($menu)
    {
        $getDbTitle = DB::table('menus')->select('*')->where('path','=',$menu)->first();
        $getTitle = $getDbTitle->name;
        $getPath = $getDbTitle->path;
        $userId = Auth::user()->id;
        if ($menu != 'verifikasi' && $menu != 'approval') {
            $pengajuans = DB::table('pengajuans')->select('*')->where('menu_id','=',$getDbTitle->id)->where('user_id','=',$userId)->get();
            return view('pages.pengajuan.index',compact('getTitle','pengajuans','getPath'));
        }else{
            
            $pengajuans = DB::table('pengajuans')->select('*');
            if ($menu == 'verifikasi') {
                $pengajuans = $pengajuans->where(function($query) {
                    $query->where('status', '=', 'waiting to approve verifikator')
                          ->orWhere('status', '=', 'waiting to approve direktur')
                          ->orWhere('status', '=', 'rejected to verifikator')
                          ->orWhere('status', '=', 'rejected to user')
                          ->orWhere('status', '=', 'approve');
                });
            }else if ($menu == 'approval') {
                $pengajuans = $pengajuans->where(function($query) {
                    $query->where('status', '=', 'waiting to approve direktur')
                          ->orWhere('status', '=', 'rejected to verifikator')
                          ->orWhere('status', '=', 'approve');
                });
            }
            $pengajuans = $pengajuans->get();
            return view('pages.pengajuan.index',compact('getTitle','pengajuans','getPath'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($menu)
    {
        $getDbTitle = DB::table('menus')->select('*')->where('path','=',$menu)->first();
        $getTitle = $getDbTitle->name;
        $getPath = $getDbTitle->path;
        return view('pages.pengajuan.create',compact('getTitle','getPath'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$menu)
    {
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'file' => 'required|file|mimes:pdf,doc,docx|max:2048',
    ]);
    $getDbTitle = DB::table('menus')->select('*')->where('path','=',$menu)->first();
    $getTitle = $getDbTitle->name;
    $getPath = $getDbTitle->path;

    $menuId = DB::table('menus')->select('id')->where('path', '=', $menu)->first()->id;
    $userId = Auth::user()->id;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $fileNameOriginal = $file->getClientOriginalName();
        $file->move(public_path('uploads'), $fileName);
    }

    DB::table('pengajuans')->insert([
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'file' => $fileName,
        'menu_id' => $menuId,
        'user_id' => $userId,
        'status' => 'waiting to approve verifikator',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('menu',$getPath)->with('success', 'Pengajuan berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function show($menu,$id)
    {
    $getDbTitle = DB::table('menus')->select('*')->where('path', '=', $menu)->first();
    $getTitle = $getDbTitle->name;
    $getPath = $getDbTitle->path;

    $pengajuan = DB::table('pengajuans')->where('id', $id)->first();

    if (!$pengajuan) {
        return redirect()->route('menu', $getPath)->with('error', 'Pengajuan tidak ditemukan.');
    }

    return view('pages.pengajuan.show', compact('pengajuan', 'getTitle', 'getPath'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$menu, $id)
    {
        $getDbTitle = DB::table('menus')->select('*')->where('path', '=', $menu)->first();
        $getTitle = $getDbTitle->name;
        $getPath = $getDbTitle->path;

        $pengajuan = Pengajuan::find($id);
        if (!$pengajuan) {
            return redirect()->route('menu',$getPath)->with('error', 'Pengajuan tidak ditemukan.');
        }

        if ($request->status == 'rejected to verifikator') {
            $pengajuan->status_direktur = "rejected";
        }
        if ($request->status == 'rejected to user' && $pengajuan->status == 'waiting to approve direktur') {
            $pengajuan->status_direktur = "rejected";
        }else if($request->status == 'rejected to user' && $pengajuan->status == 'waiting to approve verifikator'){
            $pengajuan->status_verifikator = "rejected";
        }

        if ($request->status == "approve") {
            $pengajuan->status_verifikator = "approved";
            $pengajuan->status_direktur = "approved";
        }else if($request->status == "waiting to approve direktur"){
            $pengajuan->status_verifikator = "approved";
        }

        $pengajuan->status = $request->status;
        if (isset($request->catatan_verifikator) && $request->catatan_verifikator != null) {
            $pengajuan->catatan_verifikator = $request->catatan_verifikator;
        }
        if (isset($request->catatan_direktur) && $request->catatan_direktur != null) {
            $pengajuan->catatan_direktur = $request->catatan_direktur;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $fileNameOriginal = $file->getClientOriginalName();
            $file->move(public_path('uploads'), $fileName);
            $pengajuan->file = $fileName;
        }
        $pengajuan->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengajuan  $pengajuan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
