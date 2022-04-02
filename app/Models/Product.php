<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'products';

    protected $dates = ['deleted_at'];
    
    protected $guarded = ['id'];

    public $rules = [
        'name' => 'required',
    ];

}