<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    /**
     * Permite a un usuario seguir o dejar de seguir a otro usuario.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function follow(Request $request, $id)
    {
        $user = Auth::user();
        $followedUser = User::findOrFail($id);

        if ($user->following()->where('user_id', $id)->exists()) {
            $user->following()->detach($id);
            $followed = false;
        } else {
            $user->following()->attach($id);
            $followed = true;
        }

        return response()->json(['followed' => $followed]);
    }

}
