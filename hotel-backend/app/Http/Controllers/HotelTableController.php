<?php

namespace App\Http\Controllers;

use App\Models\HotelTable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelTableController extends Controller
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
            $hotelTable= $request->all();
            print_r($hotelTable);
            $user = $this->request->user();
            print($user->id);
            $hotelTable->user_id=$user->id;
            $hotelTable->save();
            return response()->json(['message'=>'Successfully saved hotel table','data'=>$hotelTable],200);
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    public function show(Request $request){
        try {
            $user = $this->request->user();
            $stores = HotelTable::where('user_id',$user->id)->get();
            return response()->json(['message'=>'Success','data'=>$stores],200);
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\HotelTable  $hotelTable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $hotelTable){
        try {
            $validator = $this->validateStore();
            if($validator->fails()){
                return response()->json(['message'=>$validator->messages(),'data'=>null],400);
            }
            $updatedHotelTable= $request->all();
            $hotelTables = HotelTable::where('table_id',$hotelTable)->update($updatedHotelTable);
            if($hotelTables){
                return response()->json(['message'=>'Successfully updated table by id '.$hotelTable, "data"=>$hotelTables ],200);
            }else{
                return response()->json(['message'=>'Successfully not updated table by id '.$hotelTable],400);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotelTable  $hotelTable
     * @return \Illuminate\Http\Response
     */
    public function destroy($hotelTable){
        try {
            $hotelTables = Store::where('table_id',$hotelTable)->delete();
            if($hotelTables){
                return response()->json(['message'=>'Successfully deleted table by id '.$productId],200);
            }else{
                return response()->json(['message'=>'Successfully not deleted table by id '.$productId],400);
            }
        } catch (\Exception $th) {
            return response()->json(['message'=>$th->getMessage()],400);
        }
    }

    public function validateStore(){
        return Validator::make(request()->all(), [
            'table_name' => 'required',
            'table_customer_size' => 'required',
            'table_direction' => 'required'
        ]);
    }
}
