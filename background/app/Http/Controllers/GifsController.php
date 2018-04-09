<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 11:29
 */

namespace App\Http\Controllers;

use App\Models\Gif;
use App\Transformers\GifTransformer;

class GifsController extends Controller
{
    public function index()
    {
        $gifs = Gif::query()->orderBy('id','desc')->take(3)->get();
        return $this->response->collection($gifs,new GifTransformer());
    }
}