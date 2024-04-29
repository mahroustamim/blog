<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\Datatables;

class WriterController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
        
        if ($request->ajax()) {
            $query = User::query()->where('status', 'writer');
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
        return view('dashboard.users.writer');
    }
}
