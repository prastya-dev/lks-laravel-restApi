<?php

namespace App\Http\Controllers;

use App\Models\Forms;
use App\Models\Answer;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ResponseResource;
use Illuminate\Support\Facades\Validator;

class ResponseController extends Controller
{
    public function show(){
        $response = Response::all();
        return response()->json([ "message" => 'GET all response success',
        "responses" => [ResponseResource::collection($response) ]], 200);
          
    }



        public function create(Request $request, $slug){
           $validator = Validator::make($request->all(),[
            'answers' => 'required|array',
            'answers.*.question_id' => 'required|integer|exists:questions,id',
            'answers.*.value' => 'required_if:answers.*.is_required,true|string'
           ]);


           if($validator->fails()){
            return response()->json([
                'message' => 'Invalid Field',
                'error' => $validator->errors(),
            ], 422);
           }
           $form = Forms::where('slug', $slug)->first();
           
           if(!$form){

            return response()->json([
                'message' => "form not found"
            ], 404);
           }
           $exist = Response::where('user_id', Auth::id())->where('form_id', $form->id)->first();
           // Check if the form is limited to one response per user
        if ($exist) {
            return response()->json(['message' => 'You can not submit form twice'], 422);
        }

        $responn = Response::create([
            'form_id' => $form->id,
            'user_id' => Auth::id(),
            'date' => Carbon::now(),
           ]);
     foreach($request->answers as $answer){
       $answer = Answer::create([
        'response_id' => $responn->id,
        'question_id' => $answer['question_id'],
        'value' => $answer['value'],
       ]);

       
     }   
     return response()->json(["Answer" => [Answer::all()],"Response" => [Response::all()]], 200);
        }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */}
