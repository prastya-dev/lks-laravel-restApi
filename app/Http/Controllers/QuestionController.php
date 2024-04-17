<?php

namespace App\Http\Controllers;

use App\Models\Forms;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $slug)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'choice_type' => 'required|string|in:short answer,paragraph,date,multiple choice,dropdown,checkboxes',
            'choices' => 'required_if:choice_type,multiple choice,dropdown,checkboxes|array',
            'is_required' => 'required|boolean',
        ]);
        $form = Forms::where('slug', $slug)->first();
        
        if(!$form){
            return response()->json(["Form not found"], 404);
        }
        $id = Auth::id();
        if($id !== $form->creator_id){
        return response()->json(["message" => "forbiden access",
        "id" => Auth::id(),
        "id_forms" => $form->creator_id,
        ], 403);
        }
    $request['choices'] = json_encode($request->input('choices'));
    $request['form_id'] = $form->id;
    $quest = Question::create($request->all());
    return response()->json([
        "message" => "add question succes",
        "question" => $quest,
        "id" => Auth::id(),
        "id_forms" => $form->id,
    ], 200);

    }




    public function remove($slug, $question_id){
        $form = Forms::where('slug', $slug)->first();
        $questt = Question::where('id', $question_id)->first();
        $quest = Question::findOrFail($question_id);
        $users = Auth::id();
        if(!$form){
            return response()->json(["message" => "Form not found"], 404);
        }
        if(!$questt){
            return response()->json(["message" => "Question not found"], 404);
        }
        if($users != $form->creator_id){
            return response()->json(["message" => "ANDA BUKAN USER"], 404);
        }

        $quest->delete();
        return response()->json(["message" => "delete succes", $questt], 200);

    }



    public function getall($formid){
        $quest = Question::where('form_id', $formid)->get();
        return response()->json($quest, 200);
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
