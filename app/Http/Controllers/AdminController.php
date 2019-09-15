<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
        $this->authorize('create', User::class);

        return view('admin.admin.addadmin');
    }

    public function addAdmin()
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

        request()->session()->flash('success', 'Admin created successfully');
        //return request()->all();
        return redirect('/admin');

    }
    public function showViewAdmin()
    {
        $this->authorize('viewAny', User::class);
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
        $this->authorize('update', $user);
        return view('admin.admin.editadmin');

    }
    public function editAdmin(User $user)
    {
        $this->authorize('update', $user);
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
                      </a></button> <button type="button" class="btn btn-danger" onclick= "del(' . '{{$id}}' . ')">
                        <i class="material-icons">&#xE872;</i>
                      </button></div>')->addColumn('photo', function (User $user) {

                return '<img width="50px" class="rounded-circle mr-2" src="/' . $user->photo() . '" alt="User Avatar">';
            }, 1)->rawColumns(['action', 'photo'])->toJson();

        }
        return view('admin.user.viewusers');
    }

    public function deleteUser(User $user)
    {
        $this->authorize('delete', $user);

        Storage::delete($user->pic);
        $user->delete();
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

        $company = new Company();
        $company->fill(\request()->except(['logo']))->save();

        if (\request()->logo) {

            $this->uploadCompanyLogo($company);

        }

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

        request()->session()->flash('success', 'Organization updated successfully');
        return back();

    }

}