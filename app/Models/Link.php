<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Page;

class Link extends Model
{
    use HasFactory;
    public function pages(){

        return $this->hasMany(Page::class);
    }
}
