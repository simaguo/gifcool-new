<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-10
 * Time: 10:31
 */

namespace App\Http\Controllers;

use App\Models\GifComment;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function create(Request $request)
    {
        $gif_id = $request->input('gif_id');
        $content = $request->input('content');
        $validator = Validator::make($request->all(),[
            'content' => 'required',
            'gif_id'=>'required|exists:gifs,id'
        ],[
            'required'=>'评论不能为空',
            'exists'=>'评论出错'
        ]);

        if($validator->fails()){
            throw new ValidationHttpException($validator->errors());
        }

        GifComment::query()->create([
            'gif_id'=>$gif_id,
            'content'=>$content,
            'user_id'=>Auth::id()
        ]);

        return $this->response->created();

    }


}