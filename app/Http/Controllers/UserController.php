<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Users/Index', [
            'users' => User::withTrashed()
                ->with('roles')
                ->when($request->search, function ($query, $search) {
                    $query->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('email', 'LIKE', "%{$search}%")
                        ->orWhere('phone', 'LIKE', "%{$search}%")
                        ->orWhere('address', 'LIKE', "%{$search}%")
                        ->orWhereHas('roles', function ($relation) use ($search) {
                            $relation->where('name', 'LIKE', "%{$search}%");
                        });
                })
                ->orderBy($request->sortBy ?? 'id', $request->sortDesc ?? 'asc')
                ->paginate($request->perPage)
                ->withQueryString(),
            'filters' => [
                'search' => $request->search,
                'sortBy' => $request->sortBy,
                'sortDesc' => $request->sortDesc,
                'perPage' => $request->perPage,
            ]
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id)
            return back()->with('error', 'You are logged in');

        $user->delete();

        return back()->with('success', 'Record Deleted');
    }

    public function restore($user)
    {
        User::onlyTrashed()->find($user)->restore();

        return back()->with('success', 'Record Restored');
    }

    public function forceDelete($user)
    {
        User::onlyTrashed()->find($user)->forceDelete();

        return back()->with('success', 'Record Permanently Deleted');
    }

    public function assignRolesForm(User $user)
    {
        $roles = Role::all();

        return inertia('Users/AssignRole', [
            'user' => $user,
            'roles' => $roles,
            'assigned' => $user->roles
        ]);
    }

    public function assignRoles(Request $request, User $user)
    {
        $roles = $request->input('roles');

        $user->roles()->detach();

        foreach ($roles as $key => $role)
        {
            $user->roles()->sync($roles[$key], false);
        }

        return redirect()->route('users.index')->with('success', 'Roles Assigned');
    }
}
