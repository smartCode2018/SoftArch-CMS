<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

use App\Category;
use App\Tag;

class Post extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name', 'description', 'content', 'image', 'published_at', 'category_id','user_id'
    ];

    protected $dates = [
        'published_at'
    ];

    // deletes image
    public function deleteImage(){
        Storage::delete($this->image);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

/**
 * checks if post has tag
 */
    public function hasTags($tagId){
        return in_array($tagId, $this->tags->pluck('id')->toArray());
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function scopePublished($query){
        
        return $query->where('published_at', '<=', now());
    }

    public function scopeSearched($query){
        $search = request()->query('search');

        if(!$search){
            return $query->published();
        }

        return $query->published()->where('name', 'LIKE', "%{$search}%");
    }





}
