<?php


namespace App\Http\Filters\V1;



class PageFilter extends QueryFilter {


    // tek tarih veya 2 tarih arasındaki kayıtları getirmek
    public function createdAt($value){
        $dates = explode(',', $value);

        if(count($dates) > 1){
            return $this->builder->whereBetween('created_at',$dates);
        }

        return $this->builder->whereDate('created_at', $value);
    }

    public function updatedAt($value){
        $dates = explode(',', $value);

        if(count($dates) > 1){
            return $this->builder->whereBetween('updated_at',$dates);
        }

        return $this->builder->whereDate('updated_at', $value);
    }

    //relationu ile getirmek
    public function include($value){ 
        return $this->builder->with($value);
    }


    //spesifik durumdaki kayıtları getirmek
    public function status($value){
        return $this->builder->whereIn('status', explode(',',$value));
    }

    //title'a göre arama yapmak
    public function title($value) {
        $likeStr = str_replace('*','%',$value);
        return $this->builder->where('title','like',$likeStr);
    }

    
}