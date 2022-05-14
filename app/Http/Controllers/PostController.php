<?php

namespace App\Http\Controllers;

use App\Exceptions\ValidationErrorSingularException;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // GET all
    public function index(Request $request)
    {
        $postCount = 0;
        $page = $request->page ?? 1;
        $offset = ($page - 1) * 10;

        $builder = Post::with('writer')->limit(10)->offset($offset)->orderBy('created_at', 'desc');

        if($request->writer){
            $postCount = Post::where('user_id', $request->writer)->count();
            $builder = $builder->where('user_id', $request->writer);
        } else {
            $postCount = Post::count();
        }

        $posts = $builder->get();
        return [
            'count' => $postCount,
            'current_page' => intval($page),
            'total_pages' => ceil($postCount / 10),
            'posts' => $posts,
        ];
    }

    // POST
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'regex:/^[a-z0-9]+(?:-?[a-z0-9]*)+$/',
            'image' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'Masukkan judul post Anda',
            'slug.regex' => 'Format slug tidak benar',
            'image.required' => 'Post harus memiliki URL berkas foto',
            'content.required' => 'Post harus memiliki isi'
        ]);

        if($validator->fails()){
            throw new ValidationErrorSingularException($validator);
            return;
        }

        $imageExplode = explode('/', $request->image);
        $newImageName = $originalImageName = array_pop($imageExplode);
        $newImageName[0] = 1;
        $imageExplode[] = $newImageName;

        $post = new Post();
        $post->title = $request->title;
        $post->slug = $request->slug;
        $post->image = join('/', $imageExplode);
        $post->content = $request->content;
        $post->user_id = Auth::user()->id;
        $post->save();

        rename(storage_path("app/post/$originalImageName"), storage_path("app/post/$newImageName"));

        return response()->json($post, 200);
    }

    // GET one
    public function show($id)
    {
        $post = Post::with('comments')->find($id);

        return response()->json($post, 200);
    }

    // PUT
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'slug' => 'regex:/^[a-z0-9]+(?:-?[a-z0-9]*)+$/',
            'image' => 'required',
            'content' => 'required'
        ], [
            'title.required' => 'Masukkan judul post Anda',
            'slug.regex' => 'Format slug tidak benar',
            'image.required' => 'Post harus memiliki URL berkas foto',
            'content.required' => 'Post harus memiliki isi'
        ]);

        if($validator->fails()){
            throw new ValidationErrorSingularException($validator);
            return;
        }

        $post = Post::find($id);

        $imageExplode = explode('/', $request->image);
        $newImageName = $originalImageName = array_pop($imageExplode);
        $newImageName[0] = 1;
        $imageExplode[] = $newImageName;

        $post->title = $request->title;
        $post->image = join('/', $imageExplode);
        $post->content = $request->content;
        $post->slug = $request->slug ?? $post->slug;
        $post->shares = $request->shares ?? $post->shares;
        $post->save();

        rename(storage_path("app/post/$originalImageName"), storage_path("app/post/$newImageName"));

        return response()->json('success', 200);
    }

    // DELETE
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();
        if(!$post){
            return response()->json(['status' => 'Not Found'], 404);
        }

        $imageExplode = explode('/', $post->image);
        $image = end($imageExplode);
        $path = storage_path("app/post/$image");

        if(file_exists($path)){
            unlink($path);
        }
        
        $post->delete();
        return response()->json('success', 200);
    }

    public function postImage(Request $request){
        $validator = Validator::make($request->all(), [
            'image.file' => 'Post harus memiliki berkas foto',
            'image.image' => 'Berkas bukan merupakan foto',
        ]);

        if($validator->fails()){
            throw new ValidationErrorSingularException($validator);
            return;
        }

        $filename = '0-' . bin2hex(random_bytes(10));

        $request->file('image')->storeAs('post', $filename);

        $image_url = route('resource.image', [
            'resource' => 'post',
            'name' => $filename
        ], false);

        return response()->json(['image_url' => $image_url]);
    }

    public function deleteImage($image){
        $path = storage_path("app/post/$image");
        if(!file_exists($path)){
            return response()->json(['status' => 'Not Found'], 404);
        }

        unlink($path);

        return response()->json(['status' => 'File Removed'], 200);
    }
}
