<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'username',
        'country',
        'phone',
        'address',
        'images'
    ];



    public function getImages() {
        return json_decode($this->images);
    }
}
