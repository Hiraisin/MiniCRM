<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    public $timestamps = true;
    protected $fillable = ['frist_name, last_name, email, phone, company_id'];

    public function company()
    {
        return $this->belongsTo('App\Company', 'company_id');
    }
}
