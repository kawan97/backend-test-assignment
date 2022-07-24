<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\File;
use App\Models\Snippet;
use App\Models\Link;

class Resource extends Model
{
    use HasFactory;
    protected $table = 'resources';
    Protected $fillable = ['type'];
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
