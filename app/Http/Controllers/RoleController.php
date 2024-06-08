<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role; // Import model Role

class RoleController extends Controller
{
    /**
     * Display a listing of the roles.
     *
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new role.
     *
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.create');
    }

    /**
     * Store a newly created role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $role = new Role;
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        return redirect()->route('roles.index')->with('success', 'Role baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing a specified role.
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return abort(404);
        }

        return view('roles.edit', compact('role'));
    }

    /**
     * Update the specified role in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'display_name' => 'required',
            'description' => 'required',
        ]);

        $role = Role::find($id);

        if (!$role) {
            return abort(404);
        }

        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->description = $request->input('description');
        $role->save();

        return redirect()->route('roles.show', $id)->with('success', 'Data role berhasil diperbarui!');
    }

    /**
     * Remove the specified role from storage.
     *
     * @param  int  $id
     * @return Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return abort(404);
        }

        $role->delete();

        return redirect()->route('roles.index')->with('success', 'Role berhasil dihapus!');
    }
}
