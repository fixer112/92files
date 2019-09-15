<?php

namespace App\Http\Controllers;

use App\Company;
use App\File;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use Image;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function uploadPic(User $user)
    {

        $file = request()->pic;
        //$extension = $file->getClientOriginalExtension();
        //$filename = 'profile-photo-' . time() . '.' . $extension;
        if ($user->pic) {
            Storage::delete($user->pic);

        }
        $path = $file->store('profiles');
        $image = Image::make(storage_path('app/public/' . $path))->resize(150, 150);
        $image->save(storage_path('app/public/' . $path));
        //Storage::put($path, $image);

        $user->update(['pic' => $path]);

    }

    public function uploadCompanyLogo(Company $company)
    {

        $file = request()->logo;
        //$extension = $file->getClientOriginalExtension();
        //$filename = 'profile-photo-' . time() . '.' . $extension;
        if ($company->logo) {
            Storage::delete($company->logo);

        }
        $path = $file->store('companys');
        $image = Image::make(storage_path('app/public/' . $path))->resize(150, 150);
        $image->save(storage_path('app/public/' . $path));
        //Storage::put($path, $image);

        $company->update(['logo' => $path]);

    }
    public function uploadFile($file, File $uploadedFile = null)
    {

        $extension = $file->getClientOriginalExtension();

        $path = $file->store('files');

        if ($uploadedFile) {
            Storage::delete($uploadedFile->path);
            $uploadedFile->update([
                'path' => $path,
                'format' => $extension,
            ]);
            return $uploadedFile;

        }

        $newFile = new File;
        $newFile->fill(\request()->only(['filename', 'type', 'user_id', 'admin_id']))->save();
        $newFile->update([
            'path' => $path,
            'format' => $extension,
        ]);

        return $newFile;
    }
    public function test()
    {
        return File::find(1)->folder->first()->id;
    }

    public function jsonWebBack($request, $type, $message)
    {
        if (request()->wantsJson()) {
            return [$type => $message];
        }
        request()->session()->flash($type, $message);
        return back();
    }

}