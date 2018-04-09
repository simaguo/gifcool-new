<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-9
 * Time: 15:15
 */

namespace App\Transformers;


use App\Models\Gif;
use App\Models\GifComment;
use App\Models\GifSupport;
use League\Fractal\TransformerAbstract;

class GifTransformer extends TransformerAbstract
{
    public function transform(Gif $gif)
    {
        $commets = GifComment::query()->where('gif_id',$gif->id)->count();
        $love = GifSupport::query()->where('gif_id',$gif->id)->where('support',1)->count();
        $hate = GifSupport::query()->where('gif_id',$gif->id)->where('support',0)->count();

        return [
            'id' => (int)$gif->id,
            'title' => (string)$gif->title,
            'url' => (string)$gif->remote_img_url,
            'comments'=>(int) $commets,
            'love'=>(int)$love,
            'hate'=>(int)$hate,
        ];
    }
}