<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRules;
use Validator;

class UsersController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        return view('web.users.show', compact('user'));
    }

    /**
     * Edit the user
     */
    public function edit(Request $request, User $user)
    {
        return view('web.users.edit', compact('user'));
    }

    /**
     * Update
     */
    public function update(UserRules $request, User $user)
    {
        $data = $request->all();
        $data['id'] = 1;
        // dd($data);

        $user->update($data);
        
        return redirect()
            ->route('users.show', $user->id)
            ->with('success', '个人资料更新成功！');
    }
}