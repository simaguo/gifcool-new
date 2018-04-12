<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-10
 * Time: 10:35
 */

namespace App\Transformers;


use App\Models\GifComment;
use League\Fractal\TransformerAbstract;

class CommentTransformer extends TransformerAbstract
{

    public function transform(GifComment $comments)
    {
        return [
            'id'=>(int) $comments->id,
            'content'=>(string) $comments->content,
            'created_at'=>(string) $comments->created_at,
            'user'=> [
                'uid'=>(int) $comments->user->id,
                'name'=>(string) $comments->user->name,
                'email'=>(string) $comments->user->email,
                'avatar'=>(string) $comments->user->avatar ?: 'http://online.sccnn.com/img2/5890/dog160527-01.png',
            ]
        ];
    }
}