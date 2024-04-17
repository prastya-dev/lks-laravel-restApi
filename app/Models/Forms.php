<?php

namespace App\Models;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forms extends Model
{
    use HasFactory;
    protected $fillable = [
       'id', 'name','slug','allowed_domains','description','limit_one_response','creator_id'
    ];
    public function creator(){
        return $this->belongsTo(User::class,'creator_id');
    }
    public function questions()
    {
        return $this->hasMany(Question::class, 'form_id');
    }
    public static function rules(){
        return[
            'name' => 'required',
            'slug' =>[
                'required',
                'unique:forms',
                'regex:/^[a-zA-Z0-1.-]+$/',
                'not_regex:/\s/'
            ],
        ];

    }

    public static function messages()
    {
        return [
            'slug.unique' => 'Slug sudah digunakan.',
            'slug.regex' => 'Slug harus alfanumerik dengan karakter khusus hanya dash "-" dan titik ".", tanpa spasi.'
        ];
    }
}

