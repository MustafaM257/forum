<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Psy\Util\Str;


class Post extends Model
{
    use HasFactory;
    protected static function booted()
    {
        parent::booted(); // TODO: Change the autogenerated stub
        //at each save
        static::saving(fn (self $post) => $post->fill([
            'html' => str($post->body)->markdown(
                [
                    'html_input' => 'strip',
                    'allow_unsafe_links' => false,
                    'max_nesting_level' => 4,
                ]
            )
        ]));
    }


    protected $fillable = ['title','body'];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function title(): Attribute
    {
        // This function to be fired to ensure that title of post if capitalized
        return Attribute::set(fn ($val) => \Illuminate\Support\Str::title($val));
    }

    public function showRoute(array $params = [])
    {
        return route('posts.show',[$this,\Illuminate\Support\Str::slug($this->title), ...$params]);
    }
//    public function body(): Attribute
//    {
//        return Attribute::set(fn ($value) => [
//            'body' => $value,
//            'html' => str($value)->markdown()
//        ]);
//    }
}
