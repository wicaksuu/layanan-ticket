<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use File;

class ImageController extends Controller
{
    public function index($id, $image)
    {

        $profile_path = public_path('media/'.$id. '/'. $image);
        if(File::exists($profile_path)){
            if (Auth::check() && Auth::user() || Auth::guard('customer')->check() && Auth::guard('customer')->user()) {

                return response()->file($profile_path);
            } else {
                abort(404);
            }
        }
        else {
            abort(404);
        }

    }

    public function imagedownload($id, $image)
    {
        $profile_path = public_path('media/'.$id. '/'. $image);
        return response()->download($profile_path);
    }

    public function emailtoticketshow($id, $image)
    {

        $profile_path = public_path('uploads/emailtoticket/'. $image);
        if(File::exists($profile_path)){
            if (Auth::check() && Auth::user() || Auth::guard('customer')->check() && Auth::guard('customer')->user()) {

                return response()->file($profile_path);
            } else {
                abort(404);
            }
        }
        else {
            abort(404);
        }

    }

public function emailtoticketdownload($id, $image)
{
    $profile_path = public_path('uploads/emailtoticket/'. $image);
    return response()->download($profile_path);
}

    public function guestimage($id, $image)
    {

        $profile_path = public_path('media/'.$id. '/'. $image);
        if(File::exists($profile_path)){
            if (session()->has('guestimageaccess')) {

                return response()->file($profile_path);
            } else {
                abort(404);
            }
        }
        else {
            abort(404);
        }
    }
}
