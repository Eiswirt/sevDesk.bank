<?php

namespace App\Http\Controllers\Utils;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
class Utils
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     */
    public static function responseNotAuthorized()
    {
        return response("You are not authorized")->setStatusCode(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     */
    public static function responseLimitExceed()
    {
        return response("limit exceed")->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|Response|object
     */
    public static function responseIncorrectPin()
    {
        return response("incorrect pin")->setStatusCode(Response::HTTP_NOT_ACCEPTABLE);
    }

    public static function isUserNotAuthorized(int $user_id)
    {
        return Auth::id() != $user_id;
    }

    public static function setLimit(float $limit){
        return -1 * abs($limit);
    }
}
