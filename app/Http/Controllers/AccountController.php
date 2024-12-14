<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $users = User::where('is_deleted', '!=', '1')
            ->where('role_id', '=', '3')
            ->orderBy('id', 'DESC');

        if (!empty($request->get('keyword'))) {
            $users = $users->where('name', 'like', '%' . $request->get('keyword') . '%');
        }

        $users = $users->paginate(10);

        return view('account.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('account.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->passes()) {
            $model = new User();
            $model->guid = GUIDv4();
            $model->name = $request->name;
            $model->email = $request->email;
            $model->phone = $request->phone;
            $model->role_id = '3';
            $model->status = $request->status;
            $model->password = Hash::make($request->phone);

            // save image
            if (!empty($request->photo_media_id)) {
                $model->photo_media_id = $request->photo_media_id;
                $model->save();
            }
            if ($model->save()) {
                $account = new Account();
                $account->guid = GUIDv4();
                $account->user_id = $model->id;
                $account->account_number = $model->id;
                $account->save();
            }

            return redirect()->route('account')->with('success', 'Account Open successfully.');
        } else {
            return Redirect::back()->withErrors($validator);
        }
    }
}
