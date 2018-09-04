<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
class UsersController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function show(User $user)
    {
//        dd(1);
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request, ImageUploadHandler $uploader,User $user)
    {

//        dd($request->avatar);
        $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id, 362);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }
//        dd($data);
        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功');
    }
}
