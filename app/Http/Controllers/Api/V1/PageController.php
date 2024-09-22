<?php

namespace App\Http\Controllers\Api\V1;


use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        http_response_code(201);
        return response()->json([
            "status" => "success",
            "data" => $status
        ]);
    }

    public function update(Request $req, $id){
        $status = Page::find($id)->update($req->all());

        return response()->json([
            "status" => $status,
            "message" => "Page data updated gracefully!"
        ]);
    }

    public function destroy(Request $req, $id){
        $status = Page::find($id)->delete();
        return response()->json([
            "status" => $status,
            "message" => "Page deleted gracefully!"
        ]);
    }
}
