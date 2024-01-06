<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','status','user_id'];

    public function getCheckboxAttribute()
    {
        return '
            <input class="form-check-input checkAll" type="checkbox" value="'. $this->attributes['id'] .'">
        ';
    }
    public function getActionAttribute()
    {
        $action = "";
        $action = "<a href='javascript:void(0)' class='text-primary' onclick='editHandler(".$this->attributes['id'].")'><i class='ti ti-edit fs-6'></i></a>";
        $action .= "<a href='javascript:void(0)' class='text-danger mx-2'  onclick='deleteHandler(".$this->attributes['id'].")'><i class='ti ti-trash fs-6'></i></a>";
        return $action;
    }

    public function getStatusAttribute()
    {
        $status = "";
        if($this->attributes['status'])
        {
            return '<span class="badge bg-primary">Active</span>';
        }else{
            return '<span class="badge bg-danger">Inactive</span>';
        }
    }

}
