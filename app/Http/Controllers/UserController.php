<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $users = User::where('role',0)->get();
        return view('admin.pages.User.index' ,['users'=>$users]);
    }

    public function delete($id)
    {
        $users = User::findOrFail($id);
        if ($users->images) {
            $imagePath = public_path('uploads/user/' . $users->images);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $users->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully');
    }

    public function updateStatus(Request $request)
    {
        $user_id=$request->user_id;
        $status=$request->status;
        if($status==0)
        {
            $status=1;    
        }
        else
        {
            $status=0;
        }
        $update=User::where('id', $user_id)
            ->update([
                'status' => $status,
            ]);
        return response()->json(['status' => true]);
    }
}
