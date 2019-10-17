<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Company;
//use Illuminate\Auth\Access\Gate;
use App\File;
use App\Folder;
use App\User;
use Illuminate\Support\Facades\Auth;
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

            return datatables()->of($user->files->where('type', $type))->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><button class="btn btn-success"><a href="/file/{{$id}}">
                        <i class="material-icons">cloud</i>
                      </a></button> @can("create", App\File::class)<button class="btn btn-warning"><a href="/edit_file/{{$id}}">
                        <i class="material-icons">&#xE3C9;</i>
                      </a></button> <button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                <i class="material-icons">&#xE872;</i>
                </button>@endcan</div>')->addColumn('custom_folders', function (File $file) {
                $allFolders = Folder::all();
                $boxes = '';
                foreach ($allFolders as $folder) {
                    $f = $file->folders()->get()->where('id', $folder->id)->first();
                    $check = $f ? 'checked' : '';

                    $boxes .= '<label>' . $folder->foldername . '</label><input id="folder-check" class="mr-1 folder-check" type="checkbox" onclick="checkFolder(' . $file->id . ',' . $folder->id . ')" ' . $check . '/>';
                }

                return $boxes;
            }, 1)->addColumn('company', function (File $file) {
                $company = $file->company;

                return $company ? '<a href="/company/' . $company->id . '">' . $company->name . '</a>' : "";
            })->rawColumns(['action', 'custom_folders', 'company'])->toJson();

        }

        return view('user.viewfolder');
    }

    public function showCustomFolder(Folder $folder)
    {
        $this->authorize('view', $folder);

        if (request()->wantsJson()) {

            return datatables()->of($folder->files)->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><button class="btn btn-success"><a href="/file/{{$id}}">
                        <i class="material-icons">cloud</i>
                      </a></button> @can("create", App\File::class) <button class="btn btn-warning"><a href="/edit_file/{{$id}}">
                        <i class="material-icons">&#xE3C9;</i>
                      </a></button><button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                <i class="material-icons">&#xE872;</i>
                </button>@endcan</div>')->addColumn('custom_folders', function (File $file) {
                $allFolders = Folder::all();
                $boxes = '';

                foreach ($allFolders as $folder) {
                    $f = $file->folders()->get()->where('id', $folder->id)->first();
                    $check = $f ? 'checked' : '';

                    $boxes .= '<label>' . $folder->foldername . '</label><input id="folder-check" class="mr-1 folder-check" type="checkbox" onclick="checkFolder(' . $file->id . ',' . $folder->id . ')" ' . $check . '/>';
                }

                return $boxes;
            }, 1)->addColumn('company', function (File $file) {
                $company = $file->company;
                return $company ? '<a href="/company/' . $company->id . '">' . $company->name . '</a>' : "";
            })->rawColumns(['action', 'custom_folders', 'company'])->toJson();

        }
        $user = $folder->user;
        //return $user;

        return view('user.viewcustomfolder', \compact('user'));
    }

    public function showFolderUC($uc)
    {
        $folder = Folder::where('uc', $uc)->first();
        if (!$folder) {
            \abort(404);
        }
        $files = $folder->files;
        //return $files;
        return view('user.viewfolderuc', \compact('files', 'folder'));

    }

    public function addFile(User $user)
    {

        $this->authorize('create', File::class);

        $validate = [
            //'filename' => 'required|string|max:150',
            'type' => 'required|in:education,health,others',
            'user_id' => 'required|integer',
            'admin_id' => 'required|integer',
            'files' => 'required',
            'files.*' => 'mimes:doc,pdf,docx,jpg,jpeg,png,gif|max:1024',
            'uc' => 'nullable|string|exists:companies',
        ];

        $this->validate(request(), $validate);

        $files = request()->file('files');
        //return request()->all();
        $company = null;
        if (request()->uc) {
            $company = Company::where('uc', request()->uc)->first();

        }
        //return var_dump($files);

        foreach ($files as $file) {

            $name = $file->getClientOriginalName();
            $name = pathinfo($name, PATHINFO_FILENAME);

            request()->merge(['filename' => $name]);
            //return request()->all();
            $file = $this->uploadFile($file);
            if ($company) {
                $file->update(['company_id' => $company->id]);
            }

        }
        $user = $file->user;
        $summary = Auth::user()->username . " added {count($files) files for user <a href='/user/{$user->id}'> {$user->username}</a>}";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', count($files) . ' Files Created Successfully');
        return back();

    }

    public function showEditFile(File $file)
    {
        $this->authorize('delete', $file);
        //return request()->file->company;

        $user = $file->user;
        return view('user.editfile', compact('user'));
    }

    public function editFile(File $file)
    {
        $this->authorize('delete', $file);
        //return request()->files;

        $validate = [
            'filename' => 'required|string|max:150',
            'type' => 'required|in:education,health,others',
            'file' => 'mimes:doc,pdf,docx,jpg,jpeg,png,gif|max:1024',
            'uc' => 'nullable|string|exists:companies',
        ];

        $this->validate(request(), $validate);

        if (request()->has('file')) {

            $file = $this->uploadFile(request()->file, $file);
            $file->fill(request()->only(['filename', 'type']))->save();
            if (request()->uc) {
                $company = Company::where('uc', request()->uc)->first();
                $file->update(['company_id' => $company->id]);

            }

            //return $file->path;
        }

        $user = $file->user;
        $summary = Auth::user()->username . " edited file {$file->id} for user <a href='/user/{$user->id}'> {$user->username}</a>}";

        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', ' File Updated Successfully');
        return back();

    }
    public function deleteFile(File $file)
    {
        $this->authorize('delete', $file);
        //return 'done';
        Storage::delete($file->path);

        $file->delete();

        $user = $file->user;
        $summary = Auth::user()->username . " deleted file {$file->id} for user <a href='/user/{$user->id}'> {$user->username}</a>}";

        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

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
        request()->merge(['uc' => Str::random(15)]);
        $folder = new Folder;
        $folder->fill(\request()->only(['foldername', 'user_id', 'admin_id', 'uc']))->save();
        //$folder->update(['uc' => Str::random(15)]);
        $summary = Auth::user()->username . " added folder {$folder->uc}";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Folder Created Successfully');
        return redirect('/user/' . $user->id);

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

        $summary = Auth::user()->username . " edited folder {$folder->uc}";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Folder Updated Successfully');
        return back();

    }

    public function deleteFolder(Folder $folder)
    {
        $this->authorize('delete', $folder);
        $user = $folder->user;
        //return $user;

        $folder->delete();

        $summary = Auth::user()->username . " deleted folder {$folder->uc}";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Folder Deleted Successfully');
        return redirect('/user/' . $user->id);

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

        $summary = Auth::user()->username . " File {$type} Folder ({$folder->foldername})";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        return $this->jsonWebBack(request(), 'success', 'File ' . $type . ' Folder (' . $folder->foldername . ') Successfully');

    }
    public function switchStatus(User $user)
    {
        $this->authorize('update', $user);
        $user->update(['active' => !$user->active]);
        $status = $user->active ? 'Activated' : 'Suspended';

        $summary = Auth::user()->username . " {$status} User <a href='/user/{$user->id}'> {$user->username}</a>";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        return \redirect('/user/' . $user->id);

    }

}