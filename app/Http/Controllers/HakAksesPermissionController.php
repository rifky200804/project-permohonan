<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HakAksesPermissionController extends Controller
{
    private function removeFirstSlash($text) {
        $text = preg_replace('/(?<=^|\s)\/+/', '', $text);
        return $text;
    }

    public function index(){
        $menus = Menu::all();
        return view('pages.hak_akses.index',compact('menus'));
    }

    public function edit($id){
        $menu = Menu::where('id','=',$id)->first();
        $aksesRole = explode(",",$menu->access_permission);
        return view('pages.hak_akses.edit',compact('menu','aksesRole'));
    }

    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|string|max:255',
        ]);
    
        $menu = Menu::find($id);
        $menu->name = $request->name;
        $menu->path = $this->removeFirstSlash($request->path);
        if(isset($request->role_akses)){
            $menu->access_permission = implode(',', $request->role_akses);
        }
        $menu->save();
    
        return redirect()->route('hak-akses.index')->with('success', 'Akses berhasil Dirubah');
    }
}
