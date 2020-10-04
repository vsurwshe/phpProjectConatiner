<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FoodController extends Controller
{

 
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        try {
            $validator = $this->validateStore();
            if($validator->fails()){
                return response()->json(['message'=>$validator->messages()],400);
            }
            $user = $this->request->user();
            $food= new Food();
            $food->food_name=$request->input('food_name');
            $food->food_price=$request->input('food_price');
            $food->user_id=$user->id;
            $food->save();
            return response()->json(['message'=>'Successfully saved food required','data'=>$food],200);
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request){
        try {
            $user = $this->request->user();
            $foods = Food::where('user_id',$user->id)->get();
            return response()->json(['message'=>'Success','data'=>$foods],200);
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $food){
        try {
            $validator = $this->validateStore();
            if($validator->fails()){
                return response()->json(['message'=>$validator->messages(),'data'=>null],400);
            }
            $foodRequired= $request->all();
            $foods = Food::where('food_id',$food)->update($foodRequired);
            if($foods){
                return response()->json(['message'=>'Successfully updated hotel table element by store '.$foods, "data"=>$foods ],200);
            }else{
                return response()->json(['message'=>'Successfully not updated hotel table element by store '.$foods],400);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy($food){
        try {
            $foods = Food::where('food_id',$food)->delete();
            if($foods){
                return response()->json(['message'=>'Successfully deleted food by id '.$food],200);
            }else{
                return response()->json(['message'=>'Successfully not deleted food by id '.$food],400);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    public function validateStore(){
        return Validator::make(request()->all(), [
            'food_name' => 'required',
            'food_price' => 'required',
        ]);
    }
}
