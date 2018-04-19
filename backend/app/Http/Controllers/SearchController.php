<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-16
 * Time: 9:58
 */

namespace App\Http\Controllers;


use App\Models\Gif;
use App\Transformers\GifTransformer;

class SearchController extends Controller
{
    public function index($keyword)
    {
        if($keyword){
            $keyword = urldecode($keyword);
            $result = Gif::query()->where('title','like','%'.$keyword.'%')->paginate();
            return $this->response->paginator($result,new GifTransformer());
        }

        return $this->response->noContent();
    }
}