<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $titulo = 'Contratos';
        return view('dashboard.dashboard', compact('titulo'));
    }
}
