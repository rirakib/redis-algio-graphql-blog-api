<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResourceCollection;
use App\Models\Category;
use Illuminate\Support\Facades\Redis;

class FrontendController extends Controller
{
    //

    function posts() {}

    function categories()
    {

        if ($cached = Redis::get('categories_data')) {
            return response()->json(json_decode($cached), 200);
        }

        $categories = Category::select('id', 'name', 'slug')
            ->whereHas('blogs')
            ->with('blogs:id,title,category_id')
            ->paginate(20);

        $data = (new CategoryResourceCollection($categories))->toArray(request());
        $jsonData = json_encode($data);
        Redis::set('categories_data', 600, $jsonData);
        return response()->json($data);
    }
}
