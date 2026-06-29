<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
         'name',
         'email',
         'message',
         'reply',
         'replied_at',
         'parent_id',
         'type',
         'session_token',
         'user_id'
     ];



    public function parent()
    {
        return $this->belongsTo(Contact::class, 'parent_id');
    }

    public function replies()
    {
        return $this->hasMany(Contact::class, 'parent_id');
    }

    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
