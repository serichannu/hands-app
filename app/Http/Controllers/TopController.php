<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class TopController extends Controller
{
    public function index() {
        $subjects = Subject::all();

        return view('tops.index', compact('subjects'));
    }
}
