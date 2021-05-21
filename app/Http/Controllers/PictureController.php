<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\PicturesValidation;

class PictureController extends Controller
{
    public function search(Request $request) {
        $param = $request->input('search');
        
        if($param) {
            $pictures = Picture::where('title', 'like', '%' . $param . '%')->get();
        } else {
            $pictures = Picture::all();
        }
        return response()->json($pictures);
    }

    public function show($id) {
        $picture = Picture::find($id);
        if(!$picture) {
            return response()->json(['message' => 'Resource Not Found'], 403);
        }
        return response()->json($picture);
    }

    public function store(Request $request, PicturesValidation $validation) {

        $validator = Validator::make($request->all(), $validation->rules(), $validation->messages() );
        
        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 401);
        }

        $fullFileName = $request->file('image')->getClientOriginalName();
        $fileName = pathInfo($fullFileName, PATHINFO_FILENAME);
        $extension = $request->file('image')->getClientOriginalExtension();
        $file = $fileName.'_'.time().'.'.$extension;

        $request->file('image')->storeAs('public/pictures', $file);

        $picture = Picture::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $file,
            'user_id' => Auth::user()->id
        ]);

        return response()->json($picture);
    }

    public function checkLike($id) {
        $picture = Picture::find($id);
        if(Auth::user()) {
            $like = Like::where('picture_id', $picture->id)->where('user_id', Auth::user()->id)->first();
            if($like) return response()->json(true, 200);
        }
        return response()->json(false, 200);
    }
}
