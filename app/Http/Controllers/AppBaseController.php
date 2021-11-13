<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Utils\ResponseUtil;
use Response;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return Response::json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $result = null ,$code = 404)
    {
        return Response::json(ResponseUtil::makeError($error,$result), $code);
    }

    public function sendSuccess($message)
    {
        return Response::json([
            'success' => true,
            'message' => $message
        ], 200);
    }
}
