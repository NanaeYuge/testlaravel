<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
    'first_name',
    'gender',
    'email',
    'tel1',
    'tel2',
    'tel3',
    'address',
    'building',
    'category_id',
    'message'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


}
