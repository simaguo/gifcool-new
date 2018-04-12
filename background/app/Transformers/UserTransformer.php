<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-3-28
 * Time: 17:15
 */

namespace App\Transformers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{

    public function transform(User $user)
    {
        return [
            'uid' => (int)$user->id,
            'email' => (string)$user->email,
            'name' => (string)$user->name,
            'avatar' => (string) $user->avatar ?: 'http://online.sccnn.com/img2/5890/dog160527-01.png',
            'token' => Auth::getToken()->get()
            //'created_at' => (string)$user->created_at->toDateTimeString(),
            //'updated_at' => (string)$user->updated_at->toDateTimeString(),
        ];
    }

}