<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    public $timestamps = true;
    protected $fillable = ['name, email, logo, website, created_at, updated_at'];

    public function Employees()
    {
        return $this->hasMany('App\Employee');
    }
}
