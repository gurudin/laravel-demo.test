<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRules;
use App\Handlers\ImageHandler;
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
    public function update(UserRules $request, User $user, ImageHandler $handler)
    {
        $data = $request->all();
        $data['id'] = 1;
        // dd($data);

        if ($request->avatar) {
            $result = $handler->upload($request->avatar, 'avatars', $user->id, 300);
            if ($result) {
                $data['avatar'] = $result['uri'];
            }
        }

        $user->update($data);
        
        return redirect()
            ->route('users.show', $user->id)
            ->with('success', '个人资料更新成功！');
    }
}
