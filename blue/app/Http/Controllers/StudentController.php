<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    protected $stuService;
    public function __construct(StudentService $stuService)
    {
        $this->stuService =  $stuService;
    }

    public function stu1v1(Request $request){
        $rule = [
            'stu_name'      => 'required|string',
            'phone'         => 'required|string',
            'qq'            => 'string',
            'goal_school'   => 'required|string',
            'goal_profession' => 'required|string',
        ];
        $params = $request->all();
        $validator = Validator::make($params,$rule)->fails();
        if($validator){
            return $this->error(101,'参数有误');
        }
        $data = $this->stuService->stu1v1($params);
        return $this->success($data);
    }
}
