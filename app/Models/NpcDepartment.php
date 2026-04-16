<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NpcDepartment extends Model
{
    protected $fillable = ['name', 'full_name', 'is_active'];

    public function processes()
    {
        return $this->belongsToMany(NpcProcess::class, 'npc_department_process', 'department_id', 'process_id');
    }
}
