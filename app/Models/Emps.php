<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emps extends Model
{
    use HasFactory;

    public function children()
    {
        return $this->hasMany(self::class, 'id','m_id');
    }

    public function parent()
    {
        return $this->children()->orderBy('m_id','asc')->with('parent');
    }
}
