<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory; // HasFactoryトレイト: モデルファクトリを定義し、データベースにテストデータを挿入できるようにする

    protected $fillable = [
        'name',
        'email',
        'phone',
        'description',
    ];
}
