<?php

namespace App\Http\Controllers\Core\Auth\User;

use App\Hooks\User\BeforeUserAttachedToRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Core\Auth\User\UserRoleRequest;
use App\Models\Core\Auth\Role;
use App\Models\Core\Auth\User;
use App\Services\Core\Auth\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class UserRoleController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    public function store(User $user, UserRoleRequest $request)
    {
        $user = $this->service
            ->setModel($user)
            ->beforeAttachingRole()
            ->attachRole();

        return attached_response('roles', ['user' => $user]);
    }


    public function update(User $user, UserRoleRequest $request)
    {

        $user = $this->service
            ->setModel($user)
            ->beforeDetachingRole()
            ->detachRole();

        return detached_response('user', ['user' => $user]);
    }

    public function attachUsers(Role $role, Request $request)
    {
        $request->validate([
            'users' => 'required|array'
        ]);
        $users = $request->all()['users'];

        DB::transaction(function ( ) use ($users, $role, $request ){

            foreach ($users as $user) {
                $roleId = User::with('roles')->where('id', $user)->first();

                cache()->forget('app-admin-'.$user);

                if ($roleId['roles']->first()) {
                    $roleId->roles()->detach($roleId['roles']->first()->id);
                }
            }

            BeforeUserAttachedToRole::new()
                ->setModel($role)
                ->handle();

            $role->users()->detach($request->get('users'));
            $role->users()->attach($request->get('users'));
        });

        return attached_response('users');
    }

    /*public function attachUsers(Role $roles, Request $request, $id)
    {
        $request->validate([
            'users' => 'required|array'
        ]);
        $role = $roles->find($id);
        BeforeUserAttachedToRole::new()
            ->setModel($role)
            ->handle();
        // $roles->users()->detach($request->get('users'));
        DB::table('role_user')
                    ->whereIn('user_id', $request->get('users'))
                    ->delete();
        $role->users()->attach($request->get('users'));

        return attached_response('users');

    }*/

}
