<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 11:29
 */

namespace App\Http\Controllers;

use App\Models\Gif;
use App\Models\GifComment;
use App\Transformers\CommentTransformer;
use App\Transformers\GifTransformer;

class GifsController extends Controller
{
    public function index()
    {
        $gifs = Gif::query()->orderBy('id','desc')->take(3)->get();
        return $this->response->collection($gifs,new GifTransformer());
    }

    public function show($id)
    {
        $gif = Gif::query()->where('id',$id)->first();
        return $this->response->item($gif,new GifTransformer());
    }

    public function comments($id)
    {
        $comments = GifComment::query()->with('user')->where('gif_id',$id)->orderBy('id','desc')->get();
        return $this->response->collection($comments,new CommentTransformer());
    }
}