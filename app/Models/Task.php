<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date_expired',
        'completed',
        'user_id',
    ];

    protected $appends = [
        'task_completed',
    ];

    public function getTaskCompletedAttribute()
    {
        if ($this->completed){
            return "COMPLETADA!";
        }
        return "PENDIENTE!";
    }
}
