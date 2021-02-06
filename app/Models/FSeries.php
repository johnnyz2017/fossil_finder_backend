<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FSeries extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['created_at', 'updated_at', 'system_id'];

    public function stages(){
        return $this->hasMany(FStage::class, 'series_id', 'id');
    }
}
