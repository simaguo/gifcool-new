<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 15:15
 */

namespace App\Transformers;


use App\Models\Gif;
use App\Models\GifCollection;
use App\Models\GifComment;
use App\Models\GifSupport;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class GifTransformer extends TransformerAbstract
{
    public function transform(Gif $gif)
    {
        $commets = GifComment::query()->where('gif_id',$gif->id)->count();
        $up = GifSupport::query()->where('gif_id',$gif->id)->where('support',1)->count();
        $down = GifSupport::query()->where('gif_id',$gif->id)->where('support',0)->count();
        $support = false;
        $collect = false;

        if(Auth::check()){
            $support = GifSupport::query()->where('gif_id',$gif->id)->where('user_id',Auth::id())->value('support');
            $collect = GifCollection::query()->where('gif_id',$gif->id)->where('user_id',Auth::id())->first();
        }

        return [
            'id' => (int)$gif->id,
            'title' => (string)$gif->title,
            'url' => (string)$gif->remote_img_url,
            'comments'=>(int) $commets,
            'up'=>(int)$up,
            'down'=>(int)$down,
            'support' => (boolean) $support,
            'collect' => (boolean) $collect,
        ];
    }
}