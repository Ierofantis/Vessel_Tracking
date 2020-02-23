<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __($response)
    {
        if (!is_array($response)) {
            $response = $response->toArray();
        }

        return response()->json([
            'status' => 'ok',
            'data' => isset($response['data']) ? $response['data'] : null,
            'meta' => isset($response['meta']) ? $response['meta'] : null,
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
