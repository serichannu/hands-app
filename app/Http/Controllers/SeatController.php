<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index() {
        return view('seats.index');
    }

    // public function assign() {
    //     return view('seats.assign');
    // }
    public function generateForm(Request $request) {

        $rows = $request->input('rows');
        $columns = $request->input('columns');
        $totalSeats = $rows * $columns;

        return view('seats.assign', compact('totalSeats', 'columns', 'rows'));
    }

    public function assign(Request $request) {
        // 割り当てロジック
        // ...

        return redirect()->route('top.index')->with('success', '席の割り当てが完了しました');
    }
}
