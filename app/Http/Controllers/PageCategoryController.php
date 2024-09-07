<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageCategoryStoreRequest;
use App\Models\PageCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageCategoryController extends Controller
{
    public function index(Request $request): Response
    {
        $pageCategories = PageCategory::all();
    }

    public function store(PageCategoryStoreRequest $request): Response
    {
        
    }
}
