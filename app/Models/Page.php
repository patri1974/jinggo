<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Link;

class Page extends Model
{
    use HasFactory;

    public function link(){
        return $this->belongsTo(Link::class);
    }
}
