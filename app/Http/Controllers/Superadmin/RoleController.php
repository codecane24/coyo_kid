<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $editUrl = route('superadmin.roles.edit', $row->id);
                    return '
                        <div class="text-end">
                            <div class="dropdown">
                                <a href="#" class="icon-action" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item edit-role" href="#" data-id="'.$row->id.'" data-name="'.$row->name.'">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('superadmin.role.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name'
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('superadmin.roles.index')
            ->with('success', 'Role created successfully.');
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,'.$id
        ]);

        $role->update(['name' => $request->name]);

        return redirect()->route('superadmin.roles.index')
            ->with('success', 'Role updated successfully.');
    }
}
