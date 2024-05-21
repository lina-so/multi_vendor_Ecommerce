<?php

namespace App\Http\Controllers\Dashboard\Roles;

use App\Models\Role;
use App\Models\RoleAbility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    /********************************************************************************/
    public function index()
    {
        $roles = Role::paginate();
        return view('dashboard.roles.index',compact('roles'));
    }

    /********************************************************************************/

    public function create()
    {
        return view('dashboard.roles.create',['role'=>new Role()]);

    }

    /********************************************************************************/

    public function store(Request $request)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'abilities'=>['required','array'],

        ]);

        DB::beginTransaction();
        try{
            $role = Role::create([
                'name'=>$request->name,
            ]);

            foreach($request->post('abilities') as $ability_code => $value){
                RoleAbility::create([
                    'role_id' => $role->id,
                    'ability' => $ability_code ,
                    'type'=> $value,
                ]);
            }
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }


        return redirect()->route('dashboard.roles.index')->with('success','Role added successfully');
    }

    /********************************************************************************/

    public function show(Role $role)
    {
        $role_abitlities = $role->abilities->pluck('type','ability')->toArray();
        // dd($role_abitlities);
        return view('dashboard.roles.show',compact('role_abitlities','role'));
    }

    /********************************************************************************/

    public function edit(Role $role)
    {
        $role_abitlities = $role->abilities->pluck('type','ability')->toArray();
        // dd($role_abitlities);
        return view('dashboard.roles.edit',compact('role_abitlities','role'));
    }

    /********************************************************************************/

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>['required','string','max:255'],
            'abilities'=>['required','array'],

        ]);

        DB::beginTransaction();
        try{
            $role =Role::findOrFail($id);
            $role->update([
                'name'=>$request->name,
            ]);

            foreach($request->post('abilities') as $ability_code => $value){
                RoleAbility::updateOrCreate(
                    [
                    'role_id' => $role->id,
                    'ability' => $ability_code
                    ],
                    [
                    'type'=> $value,
                     ]
            );
            }
            DB::commit();
        }catch(\Exception $e)
        {
            DB::rollBack();
            throw $e;
        }


        return redirect()->route('dashboard.roles.index')->with('success','Role updated successfully');

    }

    /********************************************************************************/

    public function deleteAllSelectedRoles(Request $request)
    {
        $delete_all_ids = explode(',',$request->delete_all_id);
        Role::whereIn('id',$delete_all_ids)->delete();
        return redirect()->route('dashboard.roles.index')->with('success','roles deleted successfully !!');
    }
    /*****************************************************************************************************/

    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('dashboard.roles.index')->with('success','Role deleted successfully');

    }


}
