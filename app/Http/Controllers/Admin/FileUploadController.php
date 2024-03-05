<?php

namespace App\Http\Controllers\Admin;

use App\Models\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    public function index()
    {
        $uploadFiles = UploadFile::get();

        return view("adminend.pages.uploadFile.index", [
            "uploadFiles" => $uploadFiles
        ]);
    }

    public function create()
    {
        return view("adminend.pages.uploadFile.create");
    }

    public function store(Request $request)
    {
        try {
            $fileName = null;
            $file     = $request->file;
            if ($file) {
                $fileName = time() . '.' . $file->getClientOriginalExtension();

                $file->move("uploads", $fileName);
            }

            $uploadFile = new UploadFile();

            $uploadFile->title     = $request->title;
            $uploadFile->file_name = $fileName;
            $uploadFile->save();

            return redirect()->route("file.index")->with("success", "File uploaded successfully");
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return back()->with("error", "Something went wrong");
        }
    }

    public function download($id)
    {
        try {
            $uploadFile = UploadFile::find($id);

            if ($uploadFile && $uploadFile->file_name && file_exists(public_path("uploads/" . $uploadFile->file_name))) {
                return response()->download(public_path("uploads/" . $uploadFile->file_name));
            } else {
                return back()->with("error", "File does not exist");
            }
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return back()->with("error", "Something went wrong");
        }
    }

    public function show($id)
    {
        try {
            $uploadFile = UploadFile::find($id);

           return view("adminend.pages.uploadFile.show", [
                "uploadFile" => $uploadFile
           ]);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return back()->with("error", "Something went wrong");
        }
    }
}
