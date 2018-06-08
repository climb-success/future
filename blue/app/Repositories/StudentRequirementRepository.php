<?php
namespace App\Repositories;

use App\Models\StudentRequirementModel;

class StudentRequirementRepository
{
    protected $stuRequireModel;

    public function __construct(StudentRequirementModel $stuRequireModel){
        $this->stuRequireModel = $stuRequireModel;
    }

    public function create($params){
        return $this->stuRequireModel->create($params);
    }
}