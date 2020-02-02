<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\DataController;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

public function ajax_list(Request $request)
{   
    $row = $request->row_data;
    $all = \App\User::paginate($row); 
    echo json_encode($all);
}

    
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        \App\User::create($data);
        return redirect()->route('home');
    }
}
