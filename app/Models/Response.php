<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'form_id','user_id','date','update'
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
