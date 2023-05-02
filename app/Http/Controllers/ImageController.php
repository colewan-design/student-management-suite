<?php
namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    function store_image(){
        return view('image_store');
   }
    function save_image(Request $request){
        $img_name = 'img_'.time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('img/'), $img_name);
        $imagePath = 'img/'.$img_name;
        Image::create(['title'=> $request->title, 'image'=>$imagePath]);
        return redirect('image-list');
   } 

    function image_list(){
        $images = Image::all();
        return view('image_list', compact('images'));
   }
}