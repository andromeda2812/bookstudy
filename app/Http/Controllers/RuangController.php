<?php

namespace App\Http\Controllers;

use App\Models\RuangUser;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = RuangUser::orderByRaw('CAST(SUBSTRING_INDEX(nama, " ", -1) AS UNSIGNED)')->get();
        return view('ruang.index', compact('ruangs'));
    }
}
