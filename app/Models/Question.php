<?php

namespace App\Models;

use App\Models\Forms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable =[
        'id','form_id','name', 'choice_type','choices','is_required'
    ];
    public function form(){
        return $this->belongsTo(Forms::class, 'form_id');
    }
}
