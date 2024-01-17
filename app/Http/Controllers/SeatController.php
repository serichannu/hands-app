<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index() {
        return view('seats.index');
    }

    public function assign() {
        return view('seats.assign');
    }
}
