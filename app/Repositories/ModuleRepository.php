<?php

namespace App\Repositories;

use App\Models\Module;

class ModuleRepository
{
    protected $entity;

    public function __construct(Module $entity)
    {
        $this->entity = $entity;
    }
    
    public function getModuleCourse()
    {
        
    }
    
    public function createNewModule()
    {
        
    }
    
    public function getModuleByCourse()
    {
        
    }
    
    public function updateModuleByUuid()
    {
        
    }
    
    public function deleteCourseByUuid()
    {
        
    }
}