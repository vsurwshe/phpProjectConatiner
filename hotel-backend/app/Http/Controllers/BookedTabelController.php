<?php

namespace App\Http\Controllers;

use App\Models\BookedTabel;
use App\Models\OrderFood;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookedTabelController extends Controller
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
            $request->request->add(['user_id' => $user->id]);
            $bookedTabel= $request->all();
            $foods = BookedTabel::create($bookedTabel);
            if($foods){
                return response()->json(['message'=>'Successfully booked hotel table', "data"=>$foods ],200);
            }else{
                return response()->json(['message'=>'Successfully not booked hotel table'],400);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\bookedTabel  $bookedTabel
     * @return \Illuminate\Http\Response
     */
    public function show(BookedTabel $BookedTabel)
    {
        try {
            $user = $this->request->user();
            $resutlArray=array();
            $bookedTabels = BookedTabel::where('user_id',$user->id)->get();
            $OrderFoodResult=array();
            if(sizeof($bookedTabels)>0){
                foreach($bookedTabels as $item){
                    $OrderFoodRecord= OrderFood::where('booked_tabel_id',$item->booked_tabel_id)->get();
                    array_push($OrderFoodResult,$OrderFoodRecord);
                }
            }
            return response()->json(['message'=>'Success','data'=>array(
                "bookedTables"=>$bookedTabels,
                "OrderFoodResult"=>$OrderFoodResult
            )],200);
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\bookedTabel  $bookedTabel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $bookedTabelId){
        try {
            $validator = $this->validateStore();
            if($validator->fails()){
                return response()->json(['message'=>$validator->messages(),'data'=>null],400);
            }
            $bookedTabel= $request->all();
            $result = BookedTabel::where('booked_tabel_id',$bookedTabelId)->update($bookedTabel);
            if($result){
                return response()->json(['message'=>'Successfully updated hotel table element by store '.$bookedTabelId, "data"=>$bookedTabel ],200);
            }else{
                return response()->json(['message'=>'Successfully not updated hotel table element by store '.$bookedTabelId],400);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\bookedTabel  $bookedTabel
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $bookedTabel){
        try {
            $foods = BookedTabel::where('booked_tabel_id',$bookedTabel)->delete();
            if($foods){
                return response()->json(['message'=>'Successfully deleted table by id '.$bookedTabel],200);
            }else{
                return response()->json(['message'=>'Successfully not deleted table by id '.$bookedTabel],404);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    public function validateStore(){
        return Validator::make(request()->all(), [
            'booked_tabel_name' => 'required',
            'booked_tabel_customer_size' => 'required',
        ]);
    }
}
