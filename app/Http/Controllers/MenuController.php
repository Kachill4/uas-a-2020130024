<?php

namespace App\Http\Controllers;

use App\Models\menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = menu::all();
        return view('menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('menus.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'id'        => 'required|max:6',
            'nama'      => 'required|max:255',
            'rekomendasi'   => 'required',
            'harga'     => 'required'
        ];

        $validated = $request->validate($rules);

        $idA = '';
        switch ($validated["id"]) {
            case "makan":
                $idA = 'MKN';
                break;
            case "minum":
                $idA = 'MNM';
                break;
            case "snack":
                $idA = 'SNK';
                break;
            default:
                $idA = 'NNN';
                break;
        }
        $idright = DB::select("SELECT RIGHT(id,3) rightid FROM menus WHERE id LIKE '$idA%' ORDER BY rightid DESC");
        if(!$idright){
            $idB = sprintf("%03d", 1);
        }else{
            $idB = sprintf("%03d", $idright[0]->rightid + 1);
        }
        $validated["id"] = $idA . $idB;

        menu::create($validated);
        $request->session()
                ->flash('success', "Menu baru yang bernama '{$validated['nama']}' berhasil ditambahkan!");
        return redirect()->route('menus.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(menu $menu)
    {
        return view('menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(menu $menu)
    {
        return view("menus.edit", compact("menu"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, menu $menu)
    {
        $rules = [
            'id'        => 'required|max:6',
            'nama'      => 'required|max:255',
            'rekomendasi'   => 'required',
            'harga'     => 'required'
        ];

        $validated = $request->validate($rules);

        $idA = '';
        switch ($validated["id"]) {
            case "makanan":
                $idA = 'MKN';
                break;
            case "minuman":
                $idA = 'MNM';
                break;
            case "snack":
                $idA = 'SNK';
                break;
            default:
                $idA = 'NNN';
                break;
        }
        $idright = DB::select("SELECT RIGHT(id,3) rightid FROM menus WHERE id LIKE '$idA%' ORDER BY rightid DESC");
        if(!$idright){
            $idB = sprintf("%04d", 1);
        }else{
            $idB = sprintf("%04d", $idright[0]->rightid + 1);
        }
        $validated["id"] = $idA . $idB;

        $menu->update($validated);
        $request->session()
                ->flash('success', "Menu bernama <b> {$validated['nama']} </b> berhasil diperbaharui!");
        return redirect()->route('menus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(menu $menu)
    {
        $menu->delete();
        return redirect(route('menus.index'))
                ->with('success', "Menu {$menu['nama']} berhasil di hapus!");
    }
}
