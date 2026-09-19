<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChurchInfo extends Model
{
    protected $table = 'church_info';

    protected $fillable = ['name', 'vision', 'mission', 'history', 'contact_info', 'social_links', 'address'];

    protected $casts = [
        'contact_info' => 'array',
        'social_links' => 'array',
    ];

    // Luôn chỉ có 1 dòng - lấy hoặc tạo mới nếu chưa tồn tại
    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], ['name' => 'Hội Thánh']);
    }
}
