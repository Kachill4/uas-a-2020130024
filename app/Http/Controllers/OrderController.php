<?php

namespace App\Http\Controllers;

use App\Models\menu;
use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = order::all();
        return view('orders.index', compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $menus = menu::all();
        return view('order', compact('menus'));
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
            'status' => 'required'
        ];
        $validated = $request->validate($rules);

        order::create($validated);
        $allmenu = menu::all()->count();
        $orderId = order::all()->last()->id;
        for ($i = 1; $i <= $allmenu; $i++) {
            if ($request['quantity' . $i] > 0) {
                DB::table('order_menu')->insert([
                    'order_id' => $orderId,
                    'menu_id' => $request['id1' . $i],
                    'quantity' => $request['quantity' . $i],
                ]);
                dump($request['id1' . $i]);
            }
        }
        // dump($request['id' . $i]);
        // dump($request['quantity' . $i]);
        $request->session()->flash('success', "Nomor {$orderId} berhasil menambahkan order!");
        // dump($request['id1' . $i]);
        return redirect(route('home.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        $pesan = DB::select(
            'SELECT o.menu_id,m.nama,m.rekomendasi,o.quantity,m.harga
            FROM order_menu o
            LEFT JOIN menus m
            ON o.menu_id = m.id
            WHERE o.order_id = ?',
            [$order->id]
        );

        $dafhar = DB::select(
            'SELECT m.rekomendasi,o.quantity*m.harga harga_satuan
            FROM order_menu o
            JOIN menus m
            ON o.menu_id = m.id
            WHERE o.order_id = ?',
            [$order->id]
        );

        $harga = 0;
        foreach ($dafhar as $dh) {
            if ($dh->rekomendasi) {
                $harga += round($dh->harga_satuan * 0.9, 2);
            } else {
                $harga += $dh->harga_satuan;
            }
        }
        $harga = round($harga * 1.11, 2);

        return view('orders.show', compact('order', 'pesan', 'harga'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        $order->delete();
        return redirect(route('order.index'))->with('success', "Berhasil menghapus order nomor {$order['id']}!");
    }
}
