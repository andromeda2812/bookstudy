<?php

namespace App\Http\Controllers;

use App\Models\RuangUser;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    public function index()
    {
        $ruangs = RuangUser::all(); // ambil semua data ruang dari tabel 'ruang'
        return view('ruang.index', compact('ruangs'));
    }
}
