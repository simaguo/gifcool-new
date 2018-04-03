<?php

namespace App\Http\Controllers;

use Dingo\Api\Routing\Helpers;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use Helpers;

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
