<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index(User $user)
    {
        return view('website.settings', compact('user'));
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('website.home');
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'confirmed'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            //delete password from input array
            $input = Arr::except($input,array('password'));    
        }

        $user->update($input);

        return redirect()->back();
    }
}
