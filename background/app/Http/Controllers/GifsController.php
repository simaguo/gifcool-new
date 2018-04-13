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
use App\Models\GifSupport;
use App\Models\GifCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GifsController extends Controller
{
    public function index()
    {
        $gifs = Gif::query()->orderBy('id','desc')->take(4)->get();
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

    public function up(Request $request)
    {
        $gif_id = $request->input('gif_id');
        $attributes = [
            'gif_id'=>$gif_id,
            'user_id'=>Auth::id()
        ];
        $values = [
            'support'=>1,
        ];
        $item = GifSupport::query()->updateOrCreate($attributes,$values);
        if($item->wasRecentlyCreated){
            return $this->response->created();
        }else{
            return $this->response->accepted();
        }

    }

    public function down(Request $request)
    {
        $gif_id = $request->input('gif_id');
        $attributes = [
            'gif_id'=>$gif_id,
            'user_id'=>Auth::id()
        ];
        $values = [
            'support'=>2,
        ];

        $item = GifSupport::query()->updateOrCreate($attributes,$values);
        if($item->wasRecentlyCreated){
            return $this->response->created();
        }else{
            return $this->response->accepted();
        }
    }

    public function collect(Request $request)
    {
        $gif_id = $request->input('gif_id');
        $attributes = [
            'gif_id'=>$gif_id,
            'user_id'=>Auth::id()
        ];
        $collect = GifCollection::query()->withTrashed()->where($attributes)->first();
        if(is_null($collect)){
            $collect = GifCollection::query()->create($attributes);
        }else if ($collect->trashed()) {
            $collect->restore();
        }else{
            $collect->delete();
        }

        if($collect->wasRecentlyCreated){
            return $this->response->created();
        }else{
            return $this->response->accepted();
        }
    }
}