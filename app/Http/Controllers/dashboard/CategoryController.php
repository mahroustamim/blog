<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;
use Illuminate\Support\Facades\Gate;
use App\Traits\UploadImage;

class CategoryController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Category::query()->with('getParent');
            return  Datatables::of($query)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '';
                    if (Gate::allows('admin', Category::class)) {
                        $actionBtn = '<a  href="' . Route('dashboard.categories.edit', $row->id) . '" class="edit btn btn-success btn-sm">' . __('words.edit') . '</a> 
                        <a data-bs-toggle="modal" href="#exampleModal" data-id="' .$row->id . '" class="delete btn btn-danger btn-sm">' . __('words.delete') . '</a>';
                    }
                    return $actionBtn;
                })
                ->addColumn('parent', function($row) {
                    if ($row->parent == 0) {
                        return __('words.mainCategory');
                    } else {
                        return $row->getParent->title;
                    }
                })
                ->rawColumns(['action', 'parent'])
                ->make(true);
        }
        return view('dashboard.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('parent', 0)->get();
        return view('dashboard.categories.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('admin', Category::class);
        $data = [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'parent' => 'required|string',
        ];

        foreach (config('app.languages') as $key => $value) {
            $data[$key . '[title]'] = 'nullable|string'; 
            $data[$key . '[content]'] = 'nullable|string'; 
        }

        $request->validate($data);
        $category = Category::create($request->except('image', '_token'));

        if ($request->file('image')) {
            $category->update(['image' => $this->upload($request->image)]);
        }
        
        return redirect()->back()->with('success', 'تم إضافة القسم بنجاح');
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
    public function edit(Category $category)
    {
        $this->authorize('admin', Category::class);
        $categories = Category::where('parent', 0)->get();
        return view('dashboard.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $this->authorize('admin', Category::class);

        $data = [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'parent' => 'required|string',
        ];

        foreach (config('app.languages') as $key => $value) {
            $data[$key . '[title]'] = 'nullable|string'; 
            $data[$key . '[content]'] = 'nullable|string'; 
        }

        $request->validate($data);
        $category->update($request->except('image', '_token'));

        if ($request->file('image')) {
            $path = public_path($category->image);
            $this->deleteFile($path);
            $category->update(['image' => $this->upload($request->image)]);
        }
        
        return redirect()->back()->with('success', 'تم تعديل القسم بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(Request $request)
    {
        $this->authorize('admin', Category::class);
        $id = $request->id;
        $category = Category::find($id);
        $category->delete();

        $path = public_path($category->image);
        $this->deleteFile($path);
        return back()->with('success',  'حذف الفاتورة بنجاح' );
    }
}
