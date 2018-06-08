<?php

namespace App\Http\Controllers;

use App\Services\StudentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
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
        if($data){
            $this->sendMail($data);
        }
        return $this->success($data);
    }

    public function sendMail($data){
        $data = $data->toArray();
        $to = config('mailUser.user');
        collect($to)->map(function($item) use($data) {
            Mail::send('emails.stuRequire',['data'=>$data],function($message) use($item) {
                $message ->to($item)->subject('生意来了');
            });
        });

    }
}
