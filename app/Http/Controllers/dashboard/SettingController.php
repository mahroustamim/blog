<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    use UploadImage;

    public function index()
    {
        $this->authorize('is_admin');
        return view('dashboard.settings');
    }

    public function update(Request $request, $id) 
    {
        $this->authorize('is_admin');
        $data = [
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'facebook' => 'nullable|string',
            'instagram' => 'nullable|string',
            'phone' => 'nullable|string',
            'email' => 'nullable|email',
        ];

        foreach (config('app.languages') as $key => $value) {
            $data[$key . '[title]'] = 'nullable|string'; 
            $data[$key . '[content]'] = 'nullable|string'; 
            $data[$key . '[address]'] = 'nullable|string'; 
        }

        $request->validate($data);
        $setting = Setting::find($id);
        
        $setting->update($request->except('logo', 'favicon', '_token'));

        if ($request->file('logo')) {
            $oldLogoPath = public_path($setting->logo);
            $this->deleteFile($oldLogoPath);
            $setting->update(['logo' => $this->upload($request->logo)]);
        }

        if ($request->file('favicon')) {
            $oldFaviconPath = public_path($setting->favicon);
            $this->deleteFile($oldFaviconPath);
            $setting->update(['favicon' => $this->upload($request->favicon)]);
        }
        
        return redirect()->back()->with('success', 'تم تعديل الاعدادات بنجاح');
    }
}
