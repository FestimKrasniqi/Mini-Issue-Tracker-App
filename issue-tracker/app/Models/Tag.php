<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color'
    ];

    protected $table = 'tag';

    protected $primaryKey = 'id';

    public function issues() {
       return $this->belongsToMany(Issue::class, 'issue_tag', 'tag_id', 'issue_id');
    }
}
