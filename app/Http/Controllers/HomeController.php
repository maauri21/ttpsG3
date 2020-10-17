<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $config= App\Models\Config::findOrFail(1);
        return view('home',compact ('config'));
    }

    public function redir()
    {
        if (auth()->check()) {
            return redirect('home');
        }
        else {
            return redirect('login');
        }
    }
}