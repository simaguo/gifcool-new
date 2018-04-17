<?php
/**
 * Created by PhpStorm.
 * User: simaguo
 * Date: 2018-4-17
 * Time: 10:21
 */

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvatarController extends Controller
{

    public function upload(Request $request)
    {
        $avatar = $request->file('avatar');
        if ($avatar->isValid()) {
            $user = Auth::user();
            $user->avatar = $avatar->storeAs('avatar', $user->id . '_' . $avatar->getClientOriginalName());
            $user->save();
        }
        return $this->response->accepted();
    }
}