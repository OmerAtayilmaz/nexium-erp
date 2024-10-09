<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;

class PageController extends Controller
{
    public function index(Request $req){   
        
  
        return PageResource::collection(Page::paginate(5));
    }

    public function show($id){
       
   
        return  new PageResource(Page::findOrFail($id));
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
