<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resource;

class File extends Model
{
    use HasFactory;
    protected $table = 'files';
    Protected $fillable = ['title', 'resource_id', 'path'];

    public function resource(){
        return $this->belongsTo(Resource::class);
    }
}
