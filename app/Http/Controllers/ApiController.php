<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PublicApiConnect;
use App\Models\{Category,Entity};
use App\Http\Resources\EntityResource;

class ApiController extends Controller
{
    public function index(){
        $entries = PublicApiConnect::extractByCategories(['Animals','Security']);

        return response()->json([
            'data' => $entries,
        ]);
    }

    public function category(Category $category){

        $entities = Entity::with('category')->where('category_id',$category->id)->get();

        return EntityResource::collection($entities);
    }
}
