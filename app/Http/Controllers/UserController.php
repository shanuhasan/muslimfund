<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        if (Auth::check() && Auth::user()->role_id != 1) {
            abort(403, 'Unauthorized action.');
        }
    }

    public function index(Request $request)
    {
        $users = User::where('is_deleted', '!=', '1')
            ->where('role_id', '!=', '3')
            ->where('id', '!=', Auth::user()->id)
            ->orderBy('id', 'DESC');

        if (!empty($request->get('keyword'))) {
            $users = $users->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $users = $users->paginate(10);

        return view('user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5',
        ]);

        if ($validator->passes()) {
            $model = new User();
            $model->guid = GUIDv4();
            $model->name = $request->name;
            $model->email = $request->email;
            $model->phone = $request->phone;
            $model->role_id = $request->role_id;
            $model->status = $request->status;
            $model->password = Hash::make($request->password);

            // save image
            if (!empty($request->photo_media_id)) {
                $media = Media::find($request->photo_media_id);
                $extArray = explode('.', $media->name);
                $ext = last($extArray);

                $newImageName = $model->id . time() . '.' . $ext;
                $sPath = public_path() . '/media/' . $media->name;
                $dPath = public_path() . '/uploads/user/' . $newImageName;
                File::copy($sPath, $dPath);

                //generate thumb
                // $dPath = public_path().'/uploads/user/thumb/'.$newImageName;
                // $img = Image::make($sPath);
                // // $img->resize(300, 200);
                // $img->fit(300, 200, function ($constraint) {
                //     $constraint->upsize();
                // });
                // $img->save($dPath);

                $model->photo_media_id = $newImageName;
                $model->save();
            }
            $model->save();

            return redirect()->route('user')->with('success', 'User added successfully.');
        } else {
            return Redirect::back()->withErrors($validator);
        }
    }

    public function edit($guid, Request $request)
    {

        $user = User::findByGuid($guid);
        if (empty($user)) {
            return redirect()->route('user');
        }

        return view('user.edit', compact('user'));
    }

    public function update($guid, Request $request)
    {
        $model = User::findByGuid($guid);
        if (empty($model)) {
            return redirect()->route('user')->with('error', 'User not found.');
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $model->id . ',id',
            'name' => 'required|min:3',
            'phone' => 'required|numeric',
            'status' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->passes()) {

            $model->email = $request->email;
            $model->name = $request->name;
            $model->phone = $request->phone;
            $model->status = $request->status;
            $model->role_id = $request->role_id;

            if ($request->password != "") {
                $model->password = Hash::make($request->password);
            }

            $model->save();

            $oldImage = $model->photo_media_id;
            // save image
            if (!empty($request->photo_media_id)) {
                $model->photo_media_id = $request->photo_media_id;
                $model->save();
                //delete old image
                File::delete(public_path() . '/media/' . $oldImage);
            }

            return redirect()->route('user')->with('success', 'User updated successfully.');
        } else {
            return Redirect::back()->withErrors($validator);
        }
    }

    public function destroy($guid, Request $request)
    {
        $model = User::findByGuid($guid);
        if (empty($model)) {
            return redirect()->route('user')->with('error', 'User not found.');
        }

        $model->is_deleted = 1;
        $model->save();

        return redirect()->route('user')->with('success', 'User deleted successfully.');
    }

    public function deletedUser(Request $request)
    {
        $users = User::where('is_deleted', '=', '1')->orderBy('id', 'DESC');

        if (!empty($request->get('keyword'))) {
            $users = $users->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $users = $users->paginate(10);

        return view('user.delete', [
            'users' => $users
        ]);
    }

    public function restore($guid)
    {
        $model = User::findByGuid($guid);
        if (empty($model)) {
            return redirect()->route('user')->with('error', 'User not found.');
        }

        $model->is_deleted = 0;
        $model->save();

        return redirect()->route('user')->with('success', 'User Restore successfully.');
    }
}
