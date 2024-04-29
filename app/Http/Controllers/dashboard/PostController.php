<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Traits\UploadImage;
use Illuminate\Auth\Middleware\Authorize;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Post $post)
    {
        if ($request->ajax()) {
            $query = Post::query()->with('category');
            return  Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                        $post = $row; 
                    
                        if (Gate::allows('update', $post)) { // Use 'allows' instead of 'authorize' to prevent exceptions and return a boolean
                            $actionBtn = '<a href="' . route('dashboard.posts.edit', $row->id) . '" class="edit btn btn-success btn-sm">' . __('words.edit') . '</a> ';
                        } else {
                            $actionBtn = '';
                        }

                        if (Gate::allows('delete', $post)) { // Additional check for delete permission
                            $actionBtn .= '<a data-bs-toggle="modal" href="#exampleModal" data-id="' .$row->id . '" class="delete btn btn-danger btn-sm">' . __('words.delete') . '</a>';
                        }
                    
                        return $actionBtn; 
                    
                })
                ->addColumn('category_name', function($row) {
                    return $row->category->title;
                    // return $row->category->translate(app()->getLocale())->title;
                }) 
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.posts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        if ($categories->isNotEmpty()) {


            //auth()->user()->can('')
            // $this->authorize('is_writer');
            // Gate::authorize('update');
            // if (!Gate::allows('is_writer')) {
            //     return 'you are not writer';
            // }
            // if (Gate::denies('is_writer')) {
            //     abort(403);
            // }
            return view('dashboard.posts.add', compact('categories'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|string',
        ];

        foreach (config('app.languages') as $key => $value) {
            $data[$key . '[title]'] = 'nullable|string'; 
            $data[$key . '[small_desc]'] = 'nullable|string'; 
            $data[$key . '[content]'] = 'nullable|string'; 
            $data[$key . '[tags]'] = 'nullable|string'; 
        }

        $request->validate($data);
        $post = Post::create($request->except('image', '_token'));
        $post->update(['user_id' => auth()->user()->id]);

        if ($request->file('image')) {
            $post->update(['image' => $this->upload($request->image)]);
        }
        
        return redirect()->back()->with('success', 'تم إضافة المنشور بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $categories = Category::all();
        return view('dashboard.posts.edit', compact('categories', 'post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        $data = [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'category_id' => 'required|string',
        ];

        foreach (config('app.languages') as $key => $value) {
            $data[$key . '[title]'] = 'nullable|string'; 
            $data[$key . '[small_desc]'] = 'nullable|string'; 
            $data[$key . '[content]'] = 'nullable|string'; 
            $data[$key . '[tags]'] = 'nullable|string'; 
        }

        $request->validate($data);
        $post->update($request->except('image', '_token'));
        $post->update(['user_id' => auth()->user()->id]);

        if ($request->file('image')) {
            $path = public_path($post->image);
            $this->deleteFile($path);
            $post->update(['image' => $this->upload($request->image)]);
        }
        
        return redirect()->back()->with('success', 'تم تعديل المنشور بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request, Post $post)
    {
        $this->authorize('delete', $post);
        $id = $request->id;
        $user = Post::find($id);
        $user->delete();
        $path = public_path($post->image);
        $this->deleteFile($path);
        return back()->with('success',  'حذف الفاتورة بنجاح' );
    }
}
