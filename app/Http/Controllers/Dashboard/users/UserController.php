<?php

namespace App\Http\Controllers\Dashboard\users;

use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;


class UserController extends Controller
{

    /********************************************************************************/
    public function index()
    {
        $users = User::paginate();
        return view('dashboard.users.index',compact('users'));
    }

    /********************************************************************************/

    public function create()
    {
        /* #items: array:3 [▼
            "Adminstrator" => 5
            "user" => 8
            "vendor" => 6
        ]
         */
        $roles = Role::pluck('id','name');
        return view('dashboard.users.create',['user'=>new User(),'roles'=>$roles]);

    }

    /********************************************************************************/

    public function store(Request $request)
    {
        // dd($request);

       $validatedData =  $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','email','unique:users,email,except,id'],
            'password'=>['required','same:confirm-password'],
            'role_id'=>['required','exists:roles,id'],
        ]);

        DB::beginTransaction();
        try{
            $password = $validatedData['password'];
            $password = Hash::make($password);

            $user = User::create($validatedData);

            $role = new RoleUser();
            $role->authorizable_type = User::class;
            $role->authorizable_id = $user->id;
            $role->role_id = $validatedData['role_id'];

            $user->roleUsers()->save($role);




            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }


        return redirect()->route('dashboard.users.index')->with('success','user added successfully');
    }

    /********************************************************************************/

    public function show(User $user)
    {
        // $user_roles = $user->roles->pluck('type','ability')->toArray();
        dd($user->roleUsers);
        return view('dashboard.users.show',compact('user_roles','user'));
    }

    /********************************************************************************/

    public function edit(User $user)
    {
        $roles = Role::pluck('id','name');

        return view('dashboard.users.edit',compact('user','roles'));
    }

    /********************************************************************************/

    public function update(Request $request, string $id)
    {

        $validatedData =  $request->validate([
            'name'=>['required','string','max:255'],
            'email'=>['required','email',Rule::unique('users','name')->ignore($id) ],
            'password'=>['required','same:confirm-password'],
            'role_id'=>['required','exists:roles,id'],
        ]);

        DB::beginTransaction();
        try{
            $user = User::findOrfail($id);
            $password = $validatedData['password'];
            $password = Hash::make($password);

            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $password,
            ]);

            $roleUser = RoleUser::updateOrCreate(
                ['authorizable_id' => $user->id, 'authorizable_type' => User::class],
                ['role_id' => $validatedData['role_id']]
            );

            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }



        return redirect()->route('dashboard.users.index')->with('success','User updated successfully');

    }

    /********************************************************************************/

    public function deleteAllSelectedUsers(Request $request)
    {
        $delete_all_ids = explode(',',$request->delete_all_id);
        User::whereIn('id',$delete_all_ids)->delete();
        return redirect()->route('dashboard.users.index')->with('success','users deleted successfully !!');
    }
    /*****************************************************************************************************/

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('dashboard.users.index')->with('success','user deleted successfully');

    }


}
