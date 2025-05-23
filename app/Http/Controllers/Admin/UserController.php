<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(Request $request)
    {
  
        if ($request->ajax()) {
            $data = User::with(['roles', 'branch'])->select('*')
            ->where('branch_id', Auth::user()->branch_id);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('created_at', function($row){
                    return $row->created_at->format('M d, Y');
                })
                ->addColumn('branch', function($row) {
                    return $row->branch ? $row->branch->branch_name : '-';
                })
                ->addColumn('role', function($row){
                    return $row->roles->pluck('name')->map(function($role) {
                        return '<span class="badge bg-primary">' . $role . '</span>';
                    })->implode(' ');
                })
                ->addColumn('actions', function($row){
                    $editUrl = route('admin.users.edit', $row->id);
                    $deleteUrl = route('admin.users.destroy', $row->id);

                    return '
                        <div class="text-end">
                            <div class="dropdown">
                                <a href="#" class="icon-action" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item edit-user" href="#" data-id="'.$row->id.'" data-name="'.$row->name.'" data-email="'.$row->email.'" data-role="'.$row->roles->pluck('id')->first().'">
                                            <i class="fas fa-edit me-2"></i>Edit
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form class="delete-form" action="'.$deleteUrl.'" method="POST" style="display:inline;">
                                            '.csrf_field().method_field('DELETE').'
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash-alt me-2"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    ';
                })
                ->rawColumns(['role', 'actions'])
                ->make(true);
        }

        $roles = Role::all();
        $branches = Branch::all();
        return view('admin.user.index', compact('roles', 'branches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id',
            'branch_id' => 'required|exists:branches,id'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'branch_id' => $request->branch_id
        ]);

        // Assign role using Spatie
        $role = Role::findById($request->role);
        $user->assignRole($role);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('superadmin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'role' => 'required|exists:roles,id'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        // Sync roles using Spatie
        $role = Role::findById($request->role);
        $user->syncRoles([$role]);

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Prevent deleting the last admin user
        if ($user->hasRole('admin') &&
            User::role('admin')->count() <= 1) {
            return redirect()->route('superadmin.users.index')
                ->with('error', 'Cannot delete the last admin user.');
        }

        $user->delete();

        return redirect()->route('superadmin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
