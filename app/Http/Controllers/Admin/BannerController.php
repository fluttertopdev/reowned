<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Banner;
use Session;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    public function edit(Request $request, $id = null)
    {
        $data = Banner::first();
        return view('admin.banner.edit', compact('data'));
    }

    public function update(Request $request)
    {
        try {

            $request->validate([
                'link' => 'required|url',
                'status' => 'required',
            ]);

            $banner = Banner::first();

            $data = $request->all();

            // IMAGE UPLOAD
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                // Define folder path
                $destinationPath = public_path('uploads/banner');

                // Create folder if not exists
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                // Generate filename
                $filename = time().'_'.$file->getClientOriginalName();

                // Move file
                $file->move($destinationPath, $filename);

                //  Delete old image (optional but recommended)
                if ($banner && $banner->image) {
                    $oldImagePath = $destinationPath . '/' . $banner->image;
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }

                $data['image'] = $filename;
            }

            $updated = Banner::addUpdate($data, $banner->id);

            if ($updated['status']) {
                return redirect()->route('banner.edit')->with('success', $updated['message']);
            }

            return back()->with('error', $updated['message']);

        } catch (\Exception $ex) {
            return back()->with('error', $ex->getMessage());
        }
    }
}
