<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'due_date',
        'project_id'
    ];

    protected $table = 'issue';

    protected $primaryKey = 'id';



    public function project() {

    return $this->belongsTo(Project::class);

   }

   public function comments() {

    return $this->hasMany(Comment::class);

   }

   public function tags() {

    return $this->belongsToMany(Tag::class, 'issue_tag', 'issue_id', 'tag_id');

  }

    public function members() {

        return $this->belongsToMany(User::class,'issue_user','issue_id','user_id');

    }

   

}
