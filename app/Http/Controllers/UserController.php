<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Pager;

class UserController extends Controller
{
    use Pager;

    public function tableName()
    {
        return 'users';
    }

    //Overriden from Pager
    public function query()
    {
        $tableName = $this->tableName();
        return DB::table($tableName)
                    ->leftJoin('ranks', 'users.rank_id', '=','ranks.id')
                    ->select(['users.*', 'ranks.description AS rank']);
    }

    public function index()
    {
        return view('user.index');
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedRequest = $request->validate([
            'marine_number' => 'required|unique:users',
            'rank_id' => 'required|exists:ranks,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'nullable',
            'suffix' => 'nullable',
            'birth_place' => 'nullable',
            'nationality' => 'nullable',
            'birthday' => 'nullable',
            'highest_career_course' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable',
            'last_promotion' => 'nullable',
        ]);
        $validatedRequest['password'] = Hash::make(12345);
        return User::create($validatedRequest);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validatedRequest = $request->validate([
            'marine_number' => 'required|unique:users,marine_number,'. $user['id'],
            'rank_id' => 'required|exists:ranks,id',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'nullable',
            'suffix' => 'nullable',
            'birth_place' => 'nullable',
            'nationality' => 'nullable',
            'birthday' => 'nullable',
            'highest_career_course' => 'nullable',
            'address' => 'nullable',
            'gender' => 'nullable',
            'last_promotion' => 'nullable',
        ]);

        return $user->update($validatedRequest);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rank  $rank
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
