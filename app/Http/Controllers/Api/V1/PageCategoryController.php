<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\PageCategoryStoreRequest;
use App\Models\PageCategory;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class PageCategoryController extends Controller
{
    public function index(Request $request) 
    {
       return response()->json(PageCategory::paginate(10));
    }

    public function show($id)
    {
        return response()->json(PageCategory::find($id));
    }
}
