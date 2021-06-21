<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'initial_content',
        'content'
    ];

    public function transform()
    {
        return [
            'id'                =>  $this->id,
            'title'             =>  $this->title,
            'slug'              =>  $this->slug,
            'initial_content'   =>  $this->initial_content,
            'content'           =>  $this->content,
            'created_at'        =>  $this->created_at->diffForHumans(),
            'updated_at'        =>  $this->updated_at->diffForHumans(),
            'actions'           =>  [
                'view_url'          =>  url('/blog/' . $this->slug),
                'edit_url'          =>  url('/blogEdit/' . $this->id),
                'delete_url'        =>  url('/blogDelete/' . $this->id)
            ]
        ];
    }
}
