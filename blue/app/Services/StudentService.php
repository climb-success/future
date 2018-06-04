<?php
namespace App\Services;

use App\Repositories\StudentRequirementRepository;
use Illuminate\Http\Request;

class StudentService
{
    protected $stuRequired;
    public function __construct(StudentRequirementRepository $stuRequired){
        $this->stuRequired = $stuRequired;
    }

    public function stu1v1($params){
        $this->stuRequired->create($params);
    }
}