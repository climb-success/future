<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Validator;
use Request;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 封装数据合法性校验
     * @param $param
     * @param $rule
     * @throws ValidationException
     */
    protected function validation($rule, $message = []){
        $param     = Request::only(array_keys($rule));
        $validator = Validator::make($param, $rule, $message);
        if ($validator->fails()) {
            throw new ValidationException($validator->messages());
        }
        return $param;
    }

    /**
     * success
     * @param null $data
     * @return \Illuminate\Http\JsonResponse
     */
    protected function success($data = null)
    {
        $returnData = [
            'status' => config('errorcode.STATUSCODE_SUCCESS'),
            'msg'    => config('errormsg.MSG_OK'),
        ];
        $data && $returnData['data'] = $data;

        return response()->json($returnData);
    }


    /**
     * fail
     * @param $code
     * @param $msg
     * @return \Illuminate\Http\JsonResponse
     */
    protected function error($code = null, $msg = null, $data = null)
    {
        $returnData['status'] = !is_null($code) ? $code : config('errorcode.STATUSCODE_ERROR');
        $returnData['msg']    = !is_null($msg) ? $msg : config('errormsg.MSG_FAIL');

        $data && $returnData['data'] = $data;

        return response()->json($returnData);
    }

}
