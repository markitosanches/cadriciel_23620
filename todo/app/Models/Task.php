<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //protected $table = "task";
    //protected $primaryKey = "taskId";
    //protected $timestamp = false;

    protected $fillable = [
        'title',
        'description',
        'completed',
        'due_date',
        'user_id' 
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

}
