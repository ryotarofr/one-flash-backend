<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_kanji',
        'name_kana',
        'nickname',
        'x_account',
        'instagram_account',
        'phone',
        'email',
        'nearest_station',
        'self_introduction',
        'stature',
        'weight',
        'user_id',
        'picture_id',
        'transportation',
    ];

    public function pictures()
    {
        return $this->hasMany(Picture::class);
    }
}
