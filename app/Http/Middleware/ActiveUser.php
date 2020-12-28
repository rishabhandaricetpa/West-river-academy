<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\ParentProfile;
use App\Models\StudentProfile;

use App\Models\User;
class ActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $id = auth()->user()->id;
        $parentProfileData = User::find($id)->parentProfile()->first();
            if ($parentProfileData->status==1) {
            $user = auth()->user();
            auth()->logout();
            $notification = array(
                'message' => 'Your account is not in active status!Please contact your admin',
                'alert-type' => 'error'
            );
            return redirect()->route('login')->with($notification);
        }
        return $next($request);
    }
}