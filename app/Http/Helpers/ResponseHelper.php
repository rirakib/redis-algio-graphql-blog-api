<?php
use App\Http\Helpers;
class ResposneHelper
{
    public static function success($data = [], $message = "Success", $statusCode = 200)
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data,
        ], $statusCode);
    }

    public static function error($message = "Something went wrong", $statusCode = 400, $errors = [])
    {
        return response()->json([
            'status'  => false,
            'message' => $message,
            'errors'  => $errors,
        ], $statusCode);
    }
}
