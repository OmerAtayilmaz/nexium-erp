<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){   
        return response()->json(Page::all());
    }

    public function show(Page $page){
        return response()->json($page);
    }

    public function store(Request $req){

  
        $status = Page::create($req->all());

        return response()->json($status);
    }
}
