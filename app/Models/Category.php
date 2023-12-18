<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public static function onCreate()
    {
        return [
            'name' => 'required|unique:categories,name'
        ];
    }

    public static function onUpdate()
    {
        return [
            'name' => 'required|unique:categories,name,' . request('id'),
            'id'   => 'required|exists:categories,id'
        ];
    }

}
