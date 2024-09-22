<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\PageCategoryStoreRequest;
use App\Models\PageCategory;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PageCategoryController extends Controller
{
    public function index(Request $request) : Response
    {
        $pageCategories = PageCategory::all();
    }

    public function store(PageCategoryStoreRequest $request)
    {
        
    }
}
