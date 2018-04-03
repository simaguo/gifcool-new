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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function index(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        if ($token = Auth::attempt(['name' => $name, 'password' => $password])) {

            return $this->response->item(Auth::user(),new UserTransformer);

        }
        return $this->response->error('login fail.', 404);
    }

    public function register(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password' );

        
    }
}