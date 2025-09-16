<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
        'semester',
        'cost',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'department_id');
    }
}
