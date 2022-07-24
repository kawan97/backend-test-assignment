<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resource;

class Link extends Model
{
    use HasFactory;
    protected $table = 'links';
    Protected $fillable = ['title', 'resource_id', 'newtabcheck','link'];

    public function resource(){
        return $this->belongsTo(Resource::class);
    }

}
