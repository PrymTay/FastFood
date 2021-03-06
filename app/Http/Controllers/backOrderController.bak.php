<?php

use App\Http\Controllers\Controller;
//namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\food;
use App\Models\food_order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use App\Models\order;


class OrderController extends Controller
{

    public function index()
    {
        $menuTable = food::all();

        return view('adminBlades.order', ['menuTable' => $menuTable]);
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
        $total = $_POST['total'];
        $food_IDS = $_POST['food_ids'];
        //echo($food_IDS);

        $userID = Auth::user()->id;

        if ($total == null) {

            return redirect()->route('order.index')
                ->with('danger', 'Order can not be empty');

        }
        else {
            $orderRecord = order::create(['user_id' => $userID]);

            $lastId = $orderRecord->id;
            $food_ids_string = json_decode($food_IDS, true);

            foreach ($food_ids_string as $value) {
                echo($value);


                $orderDetailsRecord = food_order::create(['order_id' => $lastId,
                    'food_id' => $value]);

            }


            if ($orderDetailsRecord) {
                return redirect()->route('order.index')
                    ->with('success', 'Your Order was successfully recorded');
           
            }
            else {
                return redirect()->route('order.index')
                    ->with('danger', 'Something went wrong');
            }
         }

       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //
    }
}
