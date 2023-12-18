<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'price',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public static function onCreate()
    {
        return [
            'title' => 'required|unique:menus,title',
            'body' => 'required',
            'price' => 'required',
            'category_id' => 'required|exists:categories,id'
        ];
    }

    public static function onEdit()
    {
        return [
            'id' => 'required|exists:menus,id',
            'title' => 'required|unique:menus,title,' . request('id'),
            'price' => 'required'
        ];
    }

}
