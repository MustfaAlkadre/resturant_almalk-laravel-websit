<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Trait\GeneralTrait;
use App\Models\categories_food;
use App\Models\foods;
use App\Models\offers;

class ProductController extends Controller
{
    use GeneralTrait;
    public function getAllProducts(){
        $food=foods::all();
        return  $this->returenData($food) ;
    }
    public function getAllOffers(){
        $offers=offers::all();
        return  $this->returenData($offers) ;
    }
    public function getAllCategories(){
        $category=categories_food::all();
        return  $this->returenData($category) ;
    }
}
