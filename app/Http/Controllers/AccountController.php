<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::all();
        $users = User::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');

        return view('account.account', ['accounts' => $accounts, 'users' => $users, 'roles' => $roles]);
    }

    public function create()
    {
        $users=User::all();
        $roles=Role::all();
        return view('account.create', ['users'=>$users, 'roles'=>$roles]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        Account::create([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('account.index');
    }

    public function show($id)
    {
        $account = Account::findOrFail($id);
        $user=User::find($account->user_id);
        $role=Role::find($account->role_id);
        return view('account.show', ['account'=>$account,'user'=>$user, 'role'=>$role]);
    }
    
    public function edit($id)
    {
        $account = Account::findOrFail($id);
        $users = User::pluck('name', 'id');
        $roles = Role::pluck('name', 'id');
        return view('account.edit', ['account'=>$account,'users'=>$users, 'roles'=>$roles]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role_id' => 'required|exists:roles,id',
        ]);

        $account = Account::findOrFail($id);
        $account->update([
            'user_id' => $request->user_id,
            'role_id' => $request->role_id,
        ]);

        return redirect()->route('account.index');
    }

    public function destroy($id)
    {
        $account = Account::findOrFail($id);
        $account->delete();
        return redirect()->route('account.index');
    }
}
