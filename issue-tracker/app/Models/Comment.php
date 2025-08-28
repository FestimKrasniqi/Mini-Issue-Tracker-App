<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_name',
        'body',
        'issue_id'
    ];

    protected $table = 'comment';

    protected $primaryKey = 'id';

    public function issue() {
        return $this->belongsTo(Issue::class);
    }

    
}
