<?php

namespace App\Http\Controllers;

use App\File;
use App\Folder;
use App\User;
//use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public $authType;

    public function __construct()
    {

        $this->authType = request()->wantsJson() ? 'auth:api' : 'auth';
        $this->middleware($this->authType);
        //$this->middleware('can:viewBlade,user')->except(['showCustomFolder', 'checkFolder']);

        /* if ($user = User::find(request()->user)) {
    if (Gate::denies('view-user', User::find(9))) {
    \abort('404');
    }

    } */

    }
    public function dashboard(User $user)
    {
        $this->authorize('viewBlade', $user);
        /* if (Gate::denies('view-user', $user)) {
        \abort('403');
        } */
        $folders = $user->folders; //$user->folder;
        //return $folders;

        return view('user.dashboard', compact('folders'));
    }

    public function showFolder(User $user, $type)
    {
        $this->authorize('viewBlade', $user);
        if (request()->wantsJson()) {

            return datatables()->of($user->files->where('type', $type))->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><button class="btn btn-success"><a href="/{{$path}}">
                        <i class="material-icons">cloud</i>
                      </a></button> <button class="btn btn-warning"><a href="/edit_file/{{$id}}">
                        <i class="material-icons">&#xE3C9;</i>
                      </a></button> @if(Auth::user()->type=="user")<button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                <i class="material-icons">&#xE872;</i>
                </button>@endif</div>')->addColumn('custom_folders', function (File $file) {
                $allFolders = Folder::all();
                $boxes = '';

                foreach ($allFolders as $folder) {
                    $f = $file->folders()->where('id', $folder->id)->first();
                    $check = $f ? 'checked' : '';

                    $boxes .= '<label>' . $folder->foldername . '</label><input id="folder-check" class="mr-1 folder-check" type="checkbox" onclick="checkFolder(' . $file->id . ',' . $folder->id . ')" ' . $check . '/>';
                }

                return $boxes;
            }, 1)->rawColumns(['action', 'custom_folders'])->toJson();

        }

        return view('user.viewfolder');
    }

    public function showCustomFolder(Folder $folder)
    {
        $this->authorize('view', $folder);

        if (request()->wantsJson()) {

            return datatables()->of($folder->files)->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><button class="btn btn-success"><a href="/{{$path}}">
                        <i class="material-icons">cloud</i>
                      </a></button> <button class="btn btn-warning"><a href="/edit_file/{{$id}}">
                        <i class="material-icons">&#xE3C9;</i>
                      </a></button> @if(Auth::user()->type=="user")<button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                <i class="material-icons">&#xE872;</i>
                </button>@endif</div>')->addColumn('custom_folders', function (File $file) {
                $allFolders = Folder::all();
                $boxes = '';

                foreach ($allFolders as $folder) {
                    $f = $file->folders()->where('id', $folder->id)->first();
                    $check = $f ? 'checked' : '';

                    $boxes .= '<label>' . $folder->foldername . '</label><input id="folder-check" class="mr-1 folder-check" type="checkbox" onclick="checkFolder(' . $file->id . ',' . $folder->id . ')" ' . $check . '/>';
                }

                return $boxes;
            }, 1)->rawColumns(['action', 'custom_folders'])->toJson();

        }
        $user = $folder->user;
        //return $user;

        return view('user.viewcustomfolder', \compact('user'));
    }

    public function addFile(User $user)
    {

        $this->authorize('create', File::class);

        $validate = [
            'filename' => 'required|string|max:150',
            'type' => 'required|in:education,health,others',
            'user_id' => 'required|integer',
            'admin_id' => 'required|integer',
            'file' => 'required|max:1024',
        ];
        $this->validate(request(), $validate);

        $file = request()->file;

        $this->uploadFile($file);

        request()->session()->flash('success', 'File Created Successfully');
        return back();

    }

    public function showEditFile(File $file)
    {
        $this->authorize('update', $file);
        $user = $file->user;
        return view('user.editfile', compact('user'));
    }

    public function editFile(File $file)
    {
        $this->authorize('update', $file);

        $validate = [
            'filename' => 'required|string|max:150',
            'type' => 'required|in:education,health,others',
            'file' => 'max:1024',
        ];
        $this->validate(request(), $validate);

        if (request()->file) {
            # code...
            $file = request()->file;

            $this->uploadFile($file);
        } else {
            $file->fill(request()->only(['filename', 'type']))->save();
        }

        request()->session()->flash('success', 'File Updated Successfully');
        return back();

    }
    public function deleteFile(File $file)
    {
        $this->authorize('delete', $file);
        return 'done';
        Storage::delete($file->path);

        $file->delete();
        request()->session()->flash('success', 'File deleted Successfully');
        return back();

    }
    public function showAddFolder(User $user)
    {
        $this->authorize('create', Folder::class);

        return view('user.addfolder');
    }
    public function addFolder(User $user)
    {
        $this->authorize('create', Folder::class);

        $validate = [
            'foldername' => 'required|string|max:25',
            'user_id' => 'required|integer',
            'admin_id' => 'required|integer',
        ];

        $this->validate(request(), $validate);

        $folder = new Folder;
        $folder->fill(\request()->only(['filename', 'user_id', 'admin_id']))->save();
        $folder->update(['uc' => Str::random(15)]);
        request()->session()->flash('success', 'Folder Created Successfully');
        return back();

    }

    public function showEditFolder(Folder $folder)
    {
        $this->authorize('update', $folder);
        $user = $folder->user;
        return view('user.editfolder', compact('user'));
    }

    public function editFolder(Folder $folder)
    {
        $this->authorize('update', $folder);

        $validate = [
            'foldername' => 'required|string|max:25',
        ];

        $this->validate(request(), $validate);

        $folder->fill(\request()->only(['foldername']))->save();
        request()->session()->flash('success', 'Folder Updated Successfully');
        return back();

    }

    public function deleteFolder(Folder $folder)
    {
        $this->authorize('delete', $folder);

        $folder->delete();
        request()->session()->flash('success', 'Folder Deleted Successfully');
        return back();

    }
    public function checkFolder(File $file, Folder $folder)
    {
        $this->authorize('update', $file);
        $this->authorize('update', $folder);

        $check = $folder->files->where('id', $file->id)->first();
        //$check ? $folder->files()->detach($file) : $folder->files()->attach($file);
        if ($check) {
            $folder->files()->detach($file);
            $type = 'Detached from';

        } else {
            $folder->files()->attach($file);
            $type = 'Attached to';

        }

        return $this->jsonWebBack(request(), 'success', 'File ' . $type . ' Folder (' . $folder->foldername . ') Successfully');

    }
}