<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;
    protected $table = 'resources';

    public function file(){
        return $this->hasOne(File::class);
    }
    public function link(){
        return $this->hasOne(Link::class);
    }
    public function snippet(){
        return $this->hasOne(Snippet::class);
    }

}
