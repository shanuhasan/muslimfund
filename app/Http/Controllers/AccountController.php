<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function store1(Request $request)
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


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'phone' => 'required|numeric',
            'email' => 'required|email|unique:users',
        ]);

        if ($validator->passes()) {
            DB::beginTransaction(); // Start a database transaction

            try {
                // Create user
                $user = new User();
                $user->guid = GUIDv4();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->role_id = '3';
                $user->status = $request->status;
                $user->password = Hash::make($request->phone);

                // Save user photo if provided
                if (!empty($request->photo_media_id)) {
                    $user->photo_media_id = $request->photo_media_id;
                }
                if (!empty($request->signature_media_id)) {
                    $user->signature_media_id = $request->signature_media_id;
                }
                $user->save();

                // Create account
                $account = new Account();
                $account->guid = GUIDv4();
                $account->user_id = $user->id;
                $account->account_number = $user->id;
                $account->save();

                DB::commit(); // Commit transaction if everything is successful

                return redirect()->route('account')->with('success', 'Account opened successfully.');
            } catch (\Exception $e) {
                DB::rollBack(); // Rollback transaction on failure

                return Redirect::back()->withErrors(['error' => 'Failed to create user and account: ' . $e->getMessage()]);
            }
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

        return view('account.edit', compact('user'));
    }
}
