<?php


namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Room;
use Illuminate\Support\Facades\Validator;


class RoomController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room = Room::all();

        return $this->sendResponse($room->toArray(), 'Room retrieved successfully.');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'max' => 'required',
            'topic' => 'required',
            'host' => 'required',
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $room = Room::create($input);


        return $this->sendResponse($room->toArray(), 'Room created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room = Room::find($id);


        if (is_null($room)) {
            return $this->sendError('Room not found.');
        }


        return $this->sendResponse($room->toArray(), 'Room retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $input = $request->all();


        $validator = Validator::make($input, [
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'max' => 'required',
            'topic' => 'required',
            'host' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }


        $room->name = $input['name'];
        $room->age = $input['age'];
        $room->gender = $input['gender'];
        $room->topic = $input['max'];
        $room->topic = $input['topic'];
        $room->host = $input['host'];
        $room->save();


        return $this->sendResponse($room->toArray(), 'Room updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();


        return $this->sendResponse($room->toArray(), 'Room deleted successfully.');
    }
}
