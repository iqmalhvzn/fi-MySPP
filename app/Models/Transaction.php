<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'code',
        'payment_method',
        'payment_status',
        'payment_proof',
        'user_id',
        'department_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
}
