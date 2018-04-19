<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018-3-28
 * Time: 14:13
 */

namespace App\Http\Controllers;

use App\Models\User;
use App\Transformers\UserTransformer;
use Dingo\Api\Exception\ValidationHttpException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if ($token = Auth::attempt(['email' => $email, 'password' => $password])) {

            return $this->response->item(Auth::user(),new UserTransformer);

        }
        return $this->response->error('登陆失败', 404);
    }

    public function regist(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password' );

        $this->_validate($request);

        $user = User::create([
            'name'=>$name,
            'email'=>$email,
            'password'=>Hash::make($password)
        ]);

        if ($token = Auth::attempt(['name' => $name, 'password' => $password])) {
            return $this->response->item(Auth::user(),new UserTransformer);
        }

        $this->response->error('注册失败', 404);
    }

    protected function _validate(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email'=>'required|email|unique:users',
            'name'=>'required|between:6,30',
            'password'=>'required|between:6,30',
            'repassword'=>'required|same:password',
        ],[
            'required'=>':attribute必填',
            'unique'=>':attribute已经被使用',
            'between'=>':attribute长度在:min-:max之间',
            'same'=>':attribute值必须和:other相等',
            'email'=>':attribute不符合邮箱规范'
        ],[
            'name'=>'用户名',
            'password'=>'密码',
            'repassword'=>'确认密码',
            'email'=>'邮箱'
        ]);
        if($validator->fails()){
            throw new ValidationHttpException($validator->errors());
        }
    }

    public function refresh()
    {
        return $this->returnArray(Auth::refresh());
        //return $this->response->item(Auth::user(),new UserTransformer);
    }
}