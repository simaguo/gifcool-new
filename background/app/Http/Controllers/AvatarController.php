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
use Intervention\Image\Facades\Image;

class AvatarController extends Controller
{

    public function upload(Request $request)
    {
        $avatar = $request->file('avatar');
        $width = (int) $request->toCropImgW;
        $height = (int) $request->toCropImgH;
        $x = (int) $request->toCropImgX;
        $y = (int) $request->toCropImgY;
        if ($avatar->isValid()) {
            $user = Auth::user();
            $path = storage_path('app/avatar').'/'.$user->id . '@' . $user->name.'.'.$avatar->getExtension();
            Image::make($avatar)->crop($width,$height,$x,$y)->resize(150, 150)->save($path);
            $user->avatar = $this->getFile($path);
            $user->save();
        }
        return $this->response->accepted();
    }

    protected function getFile($path)
    {
        $search = app()->basePath().'/storage/app';
        return str_replace($search,'',$path);
    }


}