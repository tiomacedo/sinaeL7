<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Role extends Model  {

    
    use SoftDeletes;

    protected $table = 'roles';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'label'];
    public $rules = [
        'name' => 'required|max:50|unique:roles,name,((ID{?})),id',
        'label' => 'required|max:500'
    ];

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

}
