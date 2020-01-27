<?php

namespace App\Http\Controllers;

use App\Company;
use App\File;
use App\Folder;
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
        //$file = $re
        $extension = $file->getClientOriginalExtension();

        $path = $file->store('files');
        //return $path;

        if ($uploadedFile) {
            Storage::delete($uploadedFile->path);
            $uploadedFile->update([
                'path' => $path,
                'format' => $extension,
            ]);

            return $uploadedFile;

        }

        $newFile = new File;
        $newFile->fill(request()->only(['filename', 'type', 'user_id', 'admin_id', 'uc']))->save();
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

    public function downloadFileUc(Folder $folder, File $file)
    {
        $check = $folder->files->where('id', $file->id)->first();

        if (!$check) {
            abort('404');
        }

        return response()->file(\storage_path('/app/public/' . $file->path));
    }
    public function downloadFile(File $file)
    {
        $this->authorize('update', $file);

        return response()->file(\storage_path('/app/public/' . $file->path));
    }

    public function getSettings()
    {
        return [
            'defaultFolders' => ['education', 'health', 'others'],
            'states' => ["Abia", "Adamawa", "Anambra", "Akwa Ibom", "Bauchi",
                "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi",
                "Enugu", "Edo", "Ekiti", "FCT - Abuja", "Gombe", "Imo",
                "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi",
                "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger",
                "Ogun", "Ondo", "Osun", "Oyo", "Plateau",
                "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara",
            ],
        ];
    }

}