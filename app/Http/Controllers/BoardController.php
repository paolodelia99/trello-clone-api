<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Board;

class BoardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['boards'=> Auth::user()->boards],200);
    }


    /**
    * Get Specific board by id
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
       
        $board = Board::findOrFail($boardId);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json(['status' => 'error', 'message' => 'unauthorized'], 401);
        }

        return response()->json(['board'=> $board],200);
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,['name'=>'required']);

        Auth::user()->boards()->create([
            'name'    => $request->name,
        ]);

        return response()->json(['message' => 'success'], 200);
    }

    /**
     * Edit board name
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  int $boardId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $boardId)
    {

        $this->validate($request,['name'=>'required']);

        $board = Board::find($boardId);

        if (Auth::user()->id !== $board->user_id) {
            return response()->json(['status' => 'error', 'message' => 'unauthorized'], 401);
        }

        $board->update($request->all());

        return response()->json(['message' => 'success', 'board' => $board], 200);
    }


    /**
     * Remove the specified board from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $board=Board::find($id);

        if(Auth::user()->id !== $board->user_id) {
            return response()->json(['status'=>'error','message'=>'unauthorized'],401);
        }

        if (Board::destroy($id)) {
            return response()->json(['status' => 'success', 'message' => 'Board Deleted Successfully']);
        }

        return response()->json(['status' => 'error', 'message' => 'Something went wrong']);

    }
}
