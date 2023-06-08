<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function uploadFile(Request $request)
    {
        $uploadFile = Cloudinary::uploadFile($request->file('file')->getRealPath())->getSecurePath();
        return response()->json(
            [
                'status' => 'File Uploaded',
                'message' => 'File Upload successfully.',
                'tweet_id' => $uploadFile,
            ],
            200
        );
    }
}