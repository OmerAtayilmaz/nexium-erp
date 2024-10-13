<?php

namespace App\Decorator;

use App\Repository\Contracts\PageRepositoryInterface;
use App\Repository\PageRepository;

class CachablePages implements PageRepositoryInterface {

    protected $page;
    public function __construct(PageRepository $page){
        $this->page = $page;
    }

    
    public function all(){
     
    
        return $this->page->all();
        
    }
}