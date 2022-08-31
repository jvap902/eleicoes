<?php

namespace App\Http\Controllers;
use Livewire\Component;
use Usernotnull\Toast\Concerns\WireToast;

class HomeController extends Controller
{
    use WireToast;
    function index() {
        return view('home.index');
    }
}
