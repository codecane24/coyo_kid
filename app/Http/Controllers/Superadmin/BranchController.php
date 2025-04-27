<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use Yajra\DataTables\Facades\DataTables;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::query();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('actions', function($row){
                    $editUrl = route('superadmin.branches.edit', $row->id);
                    $deleteUrl = route('superadmin.branches.destroy', $row->id);
                    return '
                        <div class="text-end">
                            <div class="dropdown">
                                <a href="#" class="icon-action" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item edit-branch" href="#" data-id="'.$row->id.'" data-name="'.$row->branch_name.'" data-address="'.$row->branch_address.'">
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
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('superadmin.branch.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'required|string|max:255'
        ]);

        Branch::create($request->only('branch_name', 'branch_address'));

        return redirect()->route('superadmin.branches.index')
            ->with('success', 'Branch created successfully.');
    }

    public function update(Request $request, $id)
    {
        $branch = Branch::findOrFail($id);

        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_address' => 'required|string|max:255'
        ]);

        $branch->update($request->only('branch_name', 'branch_address'));

        return redirect()->route('superadmin.branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    public function destroy($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->delete();

        return redirect()->route('superadmin.branches.index')
            ->with('success', 'Branch deleted successfully.');
    }
}
