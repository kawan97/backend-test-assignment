<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resource;

class Snippet extends Model
{
    use HasFactory;
    protected $table = 'snippets';
    Protected $fillable = ['title', 'resource_id', 'description','snippet'];

    public function resource(){
        return $this->belongsTo(Resource::class);
    }

}
