<?php

namespace App\Http\Controllers;

class ResponseController extends Controller
{
    public static function sendResponse($data, $message = "")
    {
    	$response = [
            'success' => true,
            'data'    => $data,
        ];

        if($message != ""){
            $response['message'] = $message;
        }

        return response()->json($response, 200);
    }

    public static function sendError($message, $code = 404, $arrErrors = [])
    {
    	$response = [
            'success' => false,
            'message' => $message,
        ];

        if(!empty($arrErrors)){
            $response['errors'] = $arrErrors;
        }

        return response()->json($response, $code);
    }
}
