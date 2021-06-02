<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($users_id)
    {
        $items = Reservation::where('user_id',$users_id) -> with('restaurant','user') -> get();
        if($items -> isNotEmpty()){
            return response()-> json([
                'message' => 'Reservation gotton successfully',
                'data' => $items
            ],200);
        }else{
            return response() -> json([
                'message' => 'Not Reservation'
            ],404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$users_id)
    {
        $params =[
            'user_id' => $users_id,
            'restaurant_id' => $request -> restaurant_id,
            'date' => $request -> date,
            'time' => $request -> time,
            'num_users' => $request -> num_users
        ];
        $item = Reservation::create($params);
        return response()-> json([
            'message' => 'Reservation created successfully',
            'data' => $item
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reservation $reservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reservation  $reservation
     * @return \Illuminate\Http\Response
     */
    public function destroy($users_id,$reservation,Request $request)
    {

        // return response() -> json([
        //     'data' => $reservation,
        //     'data1'=> $users_id,
        //     'data2'=> $request
        // ],200);

        $item = Reservation::where('user_id',$users_id) -> where ('restaurant_id',$reservation)-> where('date',$request-> date) -> where('time',$request -> time) -> delete();
        if($item){
            return response()-> json([
                'message' => 'Deleted successfully',
            ],200);
        }else{
            return response()-> json([
                'message' => 'Not deleted',
            ],404);
        }
    }
}
