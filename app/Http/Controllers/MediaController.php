<?php

namespace App\Http\Controllers;

use App\Blog;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function blogImageUpload(Request $request)
    {
        $blog = new Blog();
        $blog->id = 0;
        $blog->exists = true;
        $image = $blog->addMediaFromRequest('upload')
            ->toMediaCollection('blog');

        return response()->json([
            'url'   =>  $image->getUrl()
        ]);
    }
}
