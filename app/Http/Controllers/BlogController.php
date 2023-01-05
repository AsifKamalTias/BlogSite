<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogFeaturedImage;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function blogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('blogs', compact('blogs'));
    }

    public function createBlog()
    {
        return view('create-blog');
    }

    public function createBlogPost(Request $request)
    {
        $this->validate($request,
        [
            'title' => 'required',
            'image' => 'required|image',
            'description' => 'required'
        ],
        [
            'title.required' => 'Title is required',
            'image.required' => 'Image is required',
            'image.image' => 'Choose an image file',
            'description.required' => 'Content is required'
        ]);

        $blogImage = time() .''.Str::random(10). '-blog-image.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('storage/blog-images'), $blogImage);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->image = $blogImage;
        $blog->user_id = Session()->get('user');
        $blog->save();

        if($request->featured_images != null)
        {
            foreach($request->featured_images as $featured_image)
            {
                $featuredImage = time().''.Str::random(10) . '-featured-image.' . $featured_image->getClientOriginalExtension();
                $featured_image->move(public_path('storage/featured-images'), $featuredImage);

                $blogFeaturedImage = new BlogFeaturedImage();
                $blogFeaturedImage->blog_id = $blog->id;
                $blogFeaturedImage->image = $featuredImage;
                $blogFeaturedImage->save();
            }
        }
        
        
        Session()->flash('blog-create-success', 'Blog posted successfully!');
        return redirect()->route('userProfile');

    }

    public function blog($id)
    {
        $blog = Blog::find($id);
        if($blog == null)
        {
            return redirect()->route('blogs');
        }
        return view('blog', compact('blog'));
    }

    public function blogDelete($id)
    {
        $blog = Blog::find($id);
        if($blog == null)
        {
            return redirect()->route('userProfile');
        }

        if($blog->user_id != Session()->get('user'))
        {
            return redirect()->route('userProfile');
        }
        
        $featured_images = BlogFeaturedImage::where('blog_id', $blog->id)->get();
        foreach($featured_images as $featured_image)
        {
            Storage::delete('public/featured-images/'.$featured_image->image);
            $featured_image->delete();
        }
        Storage::delete('public/blog-images/'.$blog->image);
        $blog->delete();
        Session()->flash('blog-delete-success', 'Blog deleted successfully!');
        return redirect()->route('userProfile');
    }

    public function blogEdit($id)
    {
        $blog = Blog::find($id);

        if($blog == null)
        {
            return redirect()->route('userProfile');
        }

        if($blog->user_id != Session()->get('user'))
        {
            return redirect()->route('userProfile');
        }

        return view('edit-blog', compact('blog'));
    }

    public function editBlogPost(Request $request, $id)
    {
        $this->validate($request,
        [
            'title' => 'required',
            'description' => 'required'
        ],
        [
            'title.required' => 'Title is required',
            'description.required' => 'Description is required'
        ]);

        $blog = Blog::find($id);

        if($blog == null)
        {
            return redirect()->route('userProfile');
        }

        if($blog->user_id != Session()->get('user'))
        {
            return redirect()->route('userProfile');
        }

        $blog->title = $request->title;
        $blog->description = $request->description;
        if($request->image != null)
        {
            Storage::delete('public/blog-images/'.$blog->image);
            $blogImage = time() .''.Str::random(10). '-blog-image.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('storage/blog-images'), $blogImage);
            $blog->image = $blogImage;
        }
        $blog->save();

        if($request->featured_images != null)
        {
            if($blog->featuredImages != null)
            {
                foreach($blog->featuredImages as $featured_image)
                {
                    Storage::delete('public/featured-images/'.$featured_image->image);
                    $featured_image->delete();
                }
            }

            foreach($request->featured_images as $featured_image)
            {
                $featuredImage = time().''.Str::random(10) . '-featured-image.' . $featured_image->getClientOriginalExtension();
                $featured_image->move(public_path('storage/featured-images'), $featuredImage);

                $blogFeaturedImage = new BlogFeaturedImage();
                $blogFeaturedImage->blog_id = $blog->id;
                $blogFeaturedImage->image = $featuredImage;
                $blogFeaturedImage->save();
            }            
        }

        Session()->flash('blog-edit-success', 'Blog updated successfully!');
        return redirect()->route('userProfile');
    }
}
