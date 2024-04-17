<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Forms;
use Illuminate\Http\Request;
use App\Http\Resources\FormResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{

    public function forms(){
        $post = Forms::where('creator_id', Auth::id())->get();
        return response()->json([
            'message' => "get forms succes",
            'forms' => FormResource::collection($post)
        ], 200);
    //    return FormResource::collection($post);
    }
    public function Detailforms($slug){
        $post = Forms::where('slug',$slug)->first();
        if(!$post){
            return response()->json(["message" => "form not found"], 200);
        }
    //    return new FormResource($post);
    return  new FormResource($post);
    }


    public function create(Request $request){
        $validator = Validator::make($request->all(),Forms::rules(),Forms::messages());
        if($validator->fails()){
            return response()->json([
            "message" => "invalid field",
            "error" => $validator->errors(),
            ],422);
        }


////<!-- rahasia1 = $2y$10$si/aT4uMuIQfrdEKIwV16OolCbbAr39CczXdNFIqmLCHHtszeEEiC -->



        ////newww formmm
        $request['creator_id'] = Auth::user()->id;
         $form = Forms::create($request->all());
         return response()->json([
            "message" => "Succes create form",
            "form" => $form
         ], 200);
        

    }
}
