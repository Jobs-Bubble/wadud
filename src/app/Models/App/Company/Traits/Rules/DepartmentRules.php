<?php


namespace App\Models\App\Company\Traits\Rules;


trait DepartmentRules
{
    public function createdRules()
    {
        return [
            'name' => 'required',
        ];
    }

    public function updatedRules()
    {
        return $this->createdRules();
    }
}