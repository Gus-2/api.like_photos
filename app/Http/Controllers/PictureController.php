<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Validation\PicturesValidation;

class PictureController extends Controller
{
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
            'title' => $file,
            'description' => $request->input('description'),
            'image' => $request->input('description'),
            'user_id' => 1
        ]);

        return response()->json($picture);
    }
}
