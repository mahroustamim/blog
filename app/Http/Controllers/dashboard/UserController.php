<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\Datatables;
use Yajra\DataTables\Html\Button;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        
        if ($request->ajax()) {
            $query = User::query()->where('status', 'user');
            return  Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a  href="' . Route('dashboard.users.edit', $row->id) . '" class="edit btn btn-success btn-sm">' . __('words.edit') . '</a> 
                    <a data-bs-toggle="modal" href="#exampleModal" data-id="' .$row->id . '" class="delete btn btn-danger btn-sm">' . __('words.delete') . '</a>';
                    return $actionBtn;
                })
                ->addColumn('status', function($row) {
                    if ($row->status == 'user') {
                        return __('words.user');
                    } elseif ($row->status == 'admin') {
                        return __('words.admin');
                    } elseif ($row->status == 'writer') {
                        return __('words.writer');
                    } else {
                        return 'null';
                    }
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('dashboard.users.index');
    }

    public function create()
    {
        $this->authorize('create', User::class);
        return view('dashboard.users.add');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);
        $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'writer',
        ]);

        return redirect()->back()->with('success', 'user added successfuly');
    }

    public function show(string $id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $this->authorize('update', $user);
        return view('dashboard.users.edit', compact('user'));
    }

    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        
        $this->authorize('update', $user);

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

        return redirect()->back()->with('success', 'user updated successfuly');
    }

    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);

        $this->authorize('delete', $user);

        $user->delete();
        return back()->with('success',  __('words.userM1') );
    }
}
