<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Company;
use App\File;
use App\Imports\UsersImport;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\MountManager;

class AdminController extends Controller
{
    public $authType;

    public function __construct()
    {
        $this->middleware('admin');
        $this->authType = request()->wantsJson() ? 'auth:api' : 'auth';
        $this->middleware($this->authType);

    }

    public function dashboard()
    {

        $admins = User::where('role', '!=', 'user')->count();
        $users = User::where('role', 'user')->count();
        $companys = Company::count();

        return view('admin.dashboard', compact('admins', 'companys', 'users'));
    }

    #ADMIN
    public function showAddAdmin()
    {
        $this->authorize('manageAdmin', User::class);

        return view('admin.admin.addadmin');
    }

    public function addAdmin()
    {

        $this->authorize('manageAdmin', User::class);

        $validate = [
            'username' => 'required|string|max:15|unique:users',
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'addr' => 'required|string|max:255',
            'num' => 'required|numeric',
            'so' => 'required|string|max:25',
            'dob' => 'date_format:Y-m-d',
            'sex' => 'required|string|in:male,female',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'type' => 'required|string|in:user,company',
            'pic' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
        $this->validate(request(), $validate);

        $user = new User();
        $user->fill(\request()->except(['password_confirmation', 'pic']))->save();
        $user->update(['api_token' => Str::random(60), 'password' => bcrypt(request()->password)]);

        if (\request()->pic) {

            $this->uploadPic($user);

        }
        $summary = Auth::user()->username . "  created Admin {$user->username}";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);
        request()->session()->flash('success', 'Admin created successfully');
        //return request()->all();
        return redirect('/admin');

    }
    public function showViewAdmin()
    {
        $this->authorize('manageAdmin', User::class);

        if (request()->wantsJson()) {

            return datatables()->of(User::where('role', 'admin'))->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><a href="/edit_admin/{{$id}}" type="button" class="btn btn-warning">
                        <i class="material-icons">&#xE3C9;</i>
                      </a> <button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                        <i class="material-icons">&#xE872;</i>
                      </button></div>')->addColumn('photo', function (User $user) {
                return '<img width="50px" class="rounded-circle mr-2" src="/' . $user->photo() . '" alt="User Avatar">';
            }, 1)->rawColumns(['action', 'photo'])->toJson();

        }
        return view('admin.admin.viewadmins');
    }

    /* public function deleteAdmin(User $user)
    {
    $this->authorize('delete', $user);
    if (!$user->isAdmin()) {
    request()->session()->flash('error', 'User is not an Admin');
    return back();

    }

    Storage::delete($user->pic);
    $user->delete();
    request()->session()->flash('success', 'Admin deleted successfully');
    return back();

    } */

    public function showEditAdmin(User $user)
    {
        $this->authorize('manageAdmin', User::class);

        return view('admin.admin.editadmin');

    }
    public function editAdmin(User $user)
    {
        $this->authorize('manageAdmin', User::class);

        if (!$user->isAdmin()) {
            request()->session()->flash('error', 'User is not an Admin');
            return back();
        }

        $validate = [
            //'username' => 'required|string|max:15|unique:users',
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'addr' => 'required|string|max:255',
            'num' => 'required|numeric',
            'so' => 'required|string|max:25',
            'dob' => 'date_format:Y-m-d',
            'sex' => 'required|string|in:male,female',
            'email' => 'required|string|email|max:100|',
            'password' => 'nullable|string|min:8|confirmed',
            //'old_password' => 'required_with:password|string',
            'type' => 'required|string|in:user,company',
            'pic' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];

        if (request()->email != $user->email) {
            $validate['email'] = 'required|string|email|max:100|unique:users';
        }
        $this->validate(request(), $validate);
        /* if (request()->password) {
        if (!Hash::check(request()->old_password, !$user->password)) {
        request()->session()->flash('error', 'Incorrect Old Password');
        return back();

        }

        } */
        //return request()->except(['password_confirmation', 'password', 'pic']);
        $user->fill(request()->except(['password_confirmation', 'pic']))->save();

        if (request()->pic) {
            $this->uploadPic($user);

        }

        $summary = Auth::user()->username . "  edited Admin {$user->username}";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Admin updated successfully');
        return back();

    }

    #USER
    public function showAddUser()
    {
        $this->authorize('create', User::class);

        return view('admin.user.adduser');
    }

    public function addUser()
    {
        $this->authorize('create', User::class);

        $validate = [
            'username' => 'required|string|max:15|unique:users',
            'fname' => 'required|string|max:25',
            'lname' => 'required|string|max:25',
            'addr' => 'required|string|max:255',
            'num' => 'required|numeric',
            'so' => 'required|string|max:25',
            'dob' => 'date_format:Y-m-d',
            'sex' => 'required|string|in:male,female',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'parent_name' => 'required|string|max:100',
            'pic' => 'image|mimes:jpeg,jpg,png|max:1024',
        ];
        $this->validate(request(), $validate);

        $user = new User();
        $user->fill(\request()->except(['password_confirmation', 'pic']))->save();
        $user->update(['api_token' => Str::random(60), 'password' => bcrypt(request()->password)]);

        if (\request()->pic) {

            $this->uploadPic($user);

        }
        $summary = Auth::user()->username . "  created User <a href='/user/{$user->id}'> {$user->username}</a>";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'User created successfully');
        //return request()->all();
        return redirect('/admin');

    }
    public function showViewUsers()
    {
        $this->authorize('viewAny', User::class);
        if (request()->wantsJson()) {

            return datatables()->of(User::where('role', 'user'))->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><button class="btn btn-success"><a href="/user/{{$id}}">
                        <i class="material-icons">visibility</i>
                      </a></button> <button class="btn btn-warning"><a href="/edit_user/{{$id}}">
                        <i class="material-icons">&#xE3C9;</i>
                      </a></button> @can("create", App\File::find($id))<button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                        <i class="material-icons">&#xE872;</i>
                   </button>@endcan</div>')->addColumn('photo', function (User $user) {

                return '<img width="50px" class="rounded-circle mr-2" src="/' . $user->photo() . '" alt="User Avatar">';
            }, 1)->rawColumns(['action', 'photo'])->toJson();

        }
        return view('admin.user.viewusers');
    }

    public function deleteUser(User $user)
    {
        $this->authorize('delete', $user);

        Storage::delete($user->pic);
        foreach ($user->files as $file) {
            Storage::delete($file->path);
            $files->delete();

        }
        /* foreach ($user->folders as $folder) {
        Storage::delete($f->path);
        $files->delete();

        } */

        //$files->delete();
        $user->folders->delete();
        $user->delete();

        $summary = Auth::user()->username . "  deleted User <a href='/user/{$user->id}'> {$user->username}</a>";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', $user->role . ' deleted successfully');
        return back();

    }

    #ORGANIZATION
    public function showAddCompany()
    {
        $this->authorize('create', Company::class);

        return view('admin.company.addcompany');
    }

    public function addCompany()
    {
        $this->authorize('create', Company::class);

        $validate = [
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'addr' => 'required|string|max:255',
            'num' => 'required|numeric',
            'state' => 'required|string|max:25',
            'grn' => 'required|string|max:25|unique:companies',
            'email' => 'required|string|email|max:100|unique:companies',
            'type' => 'required|string|in:education,health,others',
            'logo' => 'image|mimes:jpeg,jpg,png|max:1024',

        ];

        $this->validate(request(), $validate);

        request()->merge(['uc' => Str::random(10)]);
        $company = new Company();
        $company->fill(\request()->except(['logo']))->save();

        if (\request()->logo) {

            $this->uploadCompanyLogo($company);

        }
        $summary = Auth::user()->username . " created Company <a href='/company/{$company->id}'> {$company->name}</a>";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Organization created successfully');
        //return request()->all();
        return redirect('/admin');

    }
    public function showViewCompanys()
    {
        return view('admin.company.viewcompanys');

    }

    public function showViewFolderCompanys($folder)
    {
        $this->authorize('viewAny', Company::class);
        if (request()->wantsJson()) {

            return datatables()->of(Company::where('type', $folder))->addColumn('action', '<div class="btn-group btn-group-sm d-flex justify-content-end" role="group" aria-label="Table row actions"><a href="/edit_company/{{$id}}" type="button" class="btn btn-warning">
                        <i class="material-icons">&#xE3C9;</i>
                      </a> <button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                        <i class="material-icons">&#xE872;</i>
                      </button></div>')->addColumn('photo', function (Company $company) {
                return '<img width="50px" class="rounded-circle mr-2" src="/' . $company->photo() . '" alt="User Avatar">';
            }, 1)->rawColumns(['action', 'photo'])->toJson();

        }
        return view('admin.company.viewfoldercompanys');
    }

    public function deleteCompany(User $user)
    {
        $this->authorize('delete', $user);
        if (!$user->isAdmin()) {
            request()->session()->flash('error', 'User is not an Admin');
            return back();

        }

        Storage::delete($user->pic);
        $user->delete();
        $summary = Auth::user()->username . " deleted Company <a href='/company/{$company->id}'> {$company->name}</a>";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Admin deleted successfully');
        return back();

    }
    public function showEditCompany(Company $company)
    {
        $this->authorize('update', $company);
        return view('admin.company.editcompany');

    }
    public function editCompany(Company $company)
    {
        $this->authorize('update', $company);

        $validate = [
            'name' => 'required|string|max:100',
            'location' => 'required|string|max:100',
            'addr' => 'required|string|max:255',
            'num' => 'required|numeric',
            'state' => 'required|string|max:25',
            'grn' => 'required|string|max:25',
            'email' => 'required|string|email|max:100',
            'type' => 'required|string|in:education,health,others',
            'logo' => 'image|mimes:jpeg,jpg,png|max:1024',

        ];

        if (request()->email != $company->email) {
            $validate['email'] = 'required|string|email|max:100|unique:users';
        }

        if (request()->grn != $company->grn) {
            $validate['grn'] = 'required|string|max:25|unique:companies';
        }

        $this->validate(request(), $validate);

        $company->fill(request()->except(['logo']))->save();

        if (request()->logo) {
            $this->uploadCompanyLogo($company);

        }

        $summary = Auth::user()->username . " edited Company <a href='/company/{$company->id}'> {$company->name}</a>";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'Organization updated successfully');
        return back();

    }
    public function showImportUsers()
    {
        $this->authorize('create', User::class);

        return view('admin.user.bulkuser');
    }
    public function importUsers()
    {
        $this->authorize('create', User::class);

        $validate = [
            'file' => 'required|mimetypes:application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

        ];

        // try {
        $import = new UsersImport;
        $import->import(request()->file('file'));
        //} catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        $failures = $import->failures();
        $errors = '<center><h4>Error occured during user upload</h4><h6>The following affected rows was not uploaded </h6></center>';
        if (count($failures) > 0) {
            foreach ($failures as $failure) {
                $errors .= '<p>' . \implode(',', $failure->errors()) . ' at row ' . $failure->row() . ' where username is ' . $failure->values()['username'] . '</p>';
            }
            //return dd($failures);
            //$failure = $failures[0];
            //return $errors;
            request()->session()->put('fail', $errors);
            return redirect('/errors');
        }

        /* foreach ($failures as $failure) {
        $failure->row(); // row that went wrong
        $failure->attribute(); // either heading key (if using heading row concern) or column index
        $failure->errors(); // Actual error messages from Laravel validator
        $failure->values(); // The values of the row that has failed.
        $errors .= 'Error Row ' . $failure->row() . ' /n';
        return $errors;
        } */
        //}
        /* catch (\Illuminate\Database\QueryException $e) {

        return dd($e);
        request()->session()->flash('error', $e->getMessage());

        return back();

        } */
        $summary = Auth::user()->username . "  Imported bulk users";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        request()->session()->flash('success', 'All Users Uploaded');

        return back();

    }

    public function importFiles()
    {
        $files = Storage::disk('local')->files('files');
        //return dd($files);
        $error = 0;
        foreach ($files as $filepath) {
            //$file = Storage::disk('local')->get($filepath);
            //return dd($file);
            $filename = basename($filepath);
            $info = \pathinfo($filename);
            $ext = $info['extension'];
            $name = $info['filename'];
            $slash = explode('-', $name, 4);
            $newpath = 'files/' . Str::random(25) . '.' . $ext;
            //echo $newpath . '<br>';

            //echo json_encode($slash) . '<br>';

            if (count($slash) < 4) {
                $error++;
                continue;
            }
            $username = $slash[0];
            $type = $slash[1];
            $uc = $slash[2];

            $user = User::where('username', $username)->first();

            if (!$user || $user->isAdmin()) {
                $error++;
                continue;
            }

            if (!in_array($type, $this->getSettings()['defaultFolders'])) {
                $error++;
                continue;
            }

            $company = Company::where('uc', $uc)->first();

            if (!$company) {
                $error++;
                continue;
            }

            $mount = new MountManager([
                'default' => Storage::getDriver(),
                'local' => Storage::disk('local')->getDriver(),
            ]);

            File::create([
                'filename' => str::random(10),
                'type' => $type,
                'user_id' => $user->id,
                'admin_id' => Auth::id(),
                'path' => $newpath,
                'format' => $ext,
                'company_id' => $company->id,
                'uc' => str::random(10),
            ]);

            $mount->copy('local://' . $filepath, 'default://' . $newpath);

            Storage::disk('local')->delete($filepath);
            //echo json_encode($slash) . '<br>';

        }
        $summary = Auth::user()->username . "  Imported bulk files";
        Activity::create([
            'user_id' => Auth::id(),
            'summary' => $summary,

        ]);

        $message = $error > 0 ? 'Some files are not uploaded' : 'All files are uploaded';
        request()->session()->flash('success', $message);

        return redirect('/admin');
    }

    public function allStatistics()
    {
        $this->authorize('viewAny', Activity::class);
        $validate = [
            'from' => 'date',
            'to' => 'date',
            'state' => 'string',
            //'dob' => 'date_format:Y-m-d',
        ];
        $this->validate(request(), $validate);

        $from = request()->from ? Carbon::parse(request()->from) : Carbon::now();
        $to = request()->to ? Carbon::parse(request()->to) : Carbon::now();
        $selectedState = request()->state ? request()->state : 'All';

        $activities = Activity::whereBetween('created_at', [$from->startOfDay()->toDateTimeString(), $to->endOfDay()->toDateTimeString()]);

        $selectedState != 'All' ? $activities->whereHas('user', function ($query) use ($selectedState) {
            $query->where('so', $selectedState);
        }) : '';
        //('so', $selectedState) : '';
        //return $activities;

        $activities = $activities->get();

        return view('stats.all', \compact('to', 'from', 'selectedState', 'activities'));

    }

}