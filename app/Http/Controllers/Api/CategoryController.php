<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public $successStatus = 200;
    public function listCategoryBrand()
    {
        $getCategoryBrand = Category::all()->toArray();
        return response()->json([
            'response' => 'success',
            'data' => $getCategoryBrand
        ], $this->successStatus);
    }
}
