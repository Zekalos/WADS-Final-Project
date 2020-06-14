<?php

namespace App\Http\Controllers;

use App\Room;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rooms = DB::table('room');
        $rooms = $rooms->get();
        return view('home' , ['rooms' => $rooms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $input = $request->all();
        $input['host'] = Auth::user()->firstname . ' ' . Auth::user()->lastname;

        $validator = Validator::make($input, [
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'max' => 'required',
            'topic' => 'required',
            'host' => 'required'
        ]);


        if($validator->fails()){
            return $this->sendError('Validation Error', $validator->errors());
        }


        $room = Room::create($input);

        $member = new Member();
        $member->roomID = $room->id;
        $member->memberID = Auth::user()->id;

        $member->save();
        return redirect()->back()->with('success' , 'Room Created');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Request $room)
    {
        //

        $room = Room::find($room->id);
        return view('Detail.roomdetail', compact('room'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //test alex
        $room = Room::find($id);
        return view('Room.edit', compact('room'));
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
        $request->validate([
            'name' => 'required',
            'age' => 'required',
            'gender' => 'required',
            'max' => 'required',
            'topic' => 'required',
            'host' => 'required'
        ]);

        $room = Room::find($id);
        $room->name = $request->get('name');
        $room->age = $request->get('age');
        $room->gender = $request->get('gender');
        $room->max = $request->get('max');
        $room->topic = $request->get('topic');
        $room->host = $request->get('host');

        return redirect('/Room')->with('success', 'Room updated');

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
