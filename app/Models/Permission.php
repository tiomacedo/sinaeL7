<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Permission extends Model  {

    
    use SoftDeletes;

    protected $table = 'permissions';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'label']; 
    public $rules = [
        'name' => 'required|max:50|unique:permissions,name,((ID{?})),id',
        'label' => 'required|max:500'
    ];

    public function roles() {
        return $this->belongsToMany(\App\Models\Role::class);
    }

}
