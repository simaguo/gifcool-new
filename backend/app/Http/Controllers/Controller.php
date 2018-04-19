<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use Helpers;

    public function __construct()
    {
        if(env('APP_ENV')=='local'){
            DB::connection()->enableQueryLog();
            //$log = DB::getQueryLog();
        }
    }

    protected function getQueryLog()
    {
        if(env('APP_ENV')=='local'){
            return  DB::getQueryLog();
        }
        return [];
    }

    /**
     * @param string $result
     * @param int $code
     * @param string $message
     * @return mixed
     */
    public function returnArray($result = '', $code = 200, $message = 'success')
    {
        $res = [
            'message' => $message,
            'status_code' => $code,
            'data' => $result
        ];
        return $this->response->array($res)->setStatusCode($code);
    }
}
