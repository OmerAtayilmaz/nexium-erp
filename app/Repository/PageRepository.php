<?php


namespace App\Repository;

use App\Repository\Contracts\PageRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class PageRepository implements PageRepositoryInterface{

    public function all(){
        return Cache::remember('articles.all', 60*60, function(){
            return \App\Models\Page::paginate(5);
        });
    }
}