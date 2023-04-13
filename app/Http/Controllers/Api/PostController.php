<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Requests\StorePostRequest;

use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts   = Post::all();
         if($posts -> count() > 0){
            return response()->json([
            'status'=> 200,
            'messages' => $posts
         ],200);
        }else{
             return response()->json([
            'status'=> 404,
            'messages' => 'No List'
         ],404);
           }
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),
        [
            'title'=>'required',
            'description'=>'required',
        ]);

        
        if($validate ->fails()){
            return response()->json([
                'status'=> 422,
                'error' =>$validate->messages()
            ],422);
        }else{
            $posts = Post::create([
            'title'=>$request->title,
            'description'=>$request ->description,

            ]);
            if($posts){
                return response()->json([
                    'status'=> 200,
                    'messages' => ' Theem thanh cong'
                 ],200);
            }else{
                return response()->json([
                    'status'=> 500,
                    'messages' => 'something'
                 ],500);
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $posts = Post::find($id);
        if($posts){
            return response()->json([
                'status'=> 200,
                'posts' => $posts
             ],200);
        }else{
            return response()->json([
                'status'=> 500,
                'error' => 'ko tim thấy id'
             ],500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $posts = Post::find($id);
        if($posts){
            return response()->json([
                'status'=> 200,
                'posts' => $posts
             ],200);
        }else{
            return response()->json([
                'status'=> 500,
                'error' => 'ko tim thấy id'
             ],500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(),
        [
            'title'=>'required',
            'description'=>'required',
        ]);

        
        if($validate ->fails()){
            return response()->json([
                'status'=> 422,
                'error' =>$validate->messages()
            ],422);
        }else{
            $posts = Post::find($id);
          
           
            if($posts){
                  $posts ->update([
            'title'=>$request->title,
            'description'=>$request ->description,

            ]);
                return response()->json([
                    'status'=> 200,
                    'messages' => 'Update thanh cong'
                 ],200);
            }else{
                return response()->json([
                    'status'=> 500,
                    'messages' => 'something'
                 ],500);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $posts = Post::find($id);
        if($posts){
            $posts ->delete();
            return response()->json([
              'status'=> 200,
              'messages' => 'xoa thanh cong'
           ],200);
      }else{
          return response()->json([
              'status'=> 500,
              'messages' => 'something'
           ],500);
      }
    }
}