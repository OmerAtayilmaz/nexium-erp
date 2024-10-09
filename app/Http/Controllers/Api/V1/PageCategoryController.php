<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\PageCategoryStoreRequest;
use App\Models\PageCategory;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Resources\PageCategoryResource;

class PageCategoryController extends Controller
{
    public function index(Request $request) 
    {
       return PageCategoryResource::collection(PageCategory::all());
    }

    public function show($id)
    {
        return new PageCategoryResource(PageCategory::findOrFail($id));
    }
}
