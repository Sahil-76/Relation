<?php

namespace App\Http\Controllers;

use App\Models\Roll;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;


class RollController extends Controller
{ 
    // 
    /*public function index(Request $request)
    {
            // $rolls = Roll::simplePaginate(3);
        $roll=request()->roll;

        $rolls=Roll::pluck('name','id');
        // $roll=Roll::all();
        if ($request->has('roll_id')) {
            $selectedRollId = $request->has('roll_id');
            $rolls = Roll::whereIn('id', $selectedRollId)->pluck('name', 'id');
        }
        return view('rolls.index', compact('rolls'));

    }*/

    // public function index(Request $request)

    // {
    //     $rolls=Roll::simplePaginate(3);
    //     $rolls=request()->roll; 
    //     $roll['rolls']=Roll::pluck('name','id');
    //     $rolls=Roll::all();

    //     if ($request->has('roll_id')) {
    //         $rolls = $rolls->whereIn('id',$request->get('roll_id'));
    //     }
    //    return view('rolls.index', compact('rolls','request'));
    // }

   
    
    //datatables 
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $rollsQuery = Roll::with('permissions');
    
    //         if ($request->has('roll_id')) {
    //             $rollsQuery->where('id', $request->get('roll_id'));
    //         }
    //         $rolls = $rollsQuery->get();
    
    //         // $selectedRollId = $request->has('roll_id') ? $request->roll_id : null;
    //         // if ($selectedRollId) {
    //         //     $rollsQuery->whereIn('id', $selectedRollId);
    //         // }
    
    //         return DataTables::of($rollsQuery)
    //             ->addColumn('permissions', function ($roll) {
    //                 return $roll->permissions->implode('name', ',');
    //             })
    //             ->addColumn('action', function ($roll) {
    //                 $buttons = '<a class="btn btn-primary" href="' . route('rolls.edit', $roll->id) . '">Edit</a>';
    //                 $buttons .= '<form action="' . route('rolls.destroy', $roll->id) . '" method="POST" style="display: inline;">
    //                     ' . csrf_field() . '
    //                     ' . method_field('DELETE') . '
    //                     <button type="submit" class="btn btn-danger">Delete</button>
    //                 </form>';
    //                 return $buttons;
    //             })
    //             ->rawColumns(['action'])
    //             ->make(true);
    //     }
    
    //     return view('rolls.index');
    // }
    

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $rollsQuery = Roll::with('permissions');
    
            if ($request->has('roll_id')) {
                $rollsQuery->where('id', $request->get('roll_id'));
            }
    
            $rolls = $rollsQuery->get();
    
            return DataTables::of($rolls)
                ->addColumn('permissions', function ($roll) {
                    return $roll->permissions->implode('name', ', ');
                })
                ->addColumn('action', function ($roll) {
                    $buttons = '<a class="btn btn-primary" href="' . route('rolls.edit', $roll->id) . '">Edit</a>';
                    $buttons .= '<form action="' . route('rolls.destroy', $roll->id) . '" method="POST" style="display: inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>';
                    return $buttons;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    
        $rolls = Roll::all(); // Fetch all rolls
    
        return view('rolls.index', compact('rolls'));
    }
    
    





    public function create()
    {
        $rolls = Roll::all();
        return view('rolls.create',compact('rolls'));

    }

    public function store(Request  $request )
    {
        
        
        $roll = new Roll();
        $roll->name = $request->input('name');
        $roll->save();
        return redirect()->route('rolls.index')->with('success', 'rolls created successfully');
    
    }

    public function show(Roll $roll)
    {    
        return view('rolls.show', compact('roll'));
    }


    // public function edit($id)
    // {
    //     $rolls = Roll::findOrFail($id);
    //     $permissions = Permission::select('id', 'name')->get(); 
    //     // return view('users.edit', compact('roll', 'permissions'));  
    //     return view('rolls.edit', compact('rolls', 'permissions'));
    // }

    
    public function edit($id)
    {
        $rolls = Roll::findOrFail($id);
        if (Gate::denies('isAdmin', $rolls)) {
            abort(403, 'This action is not possible for you.');
        }
        $modules = Module::with('permissions')->get();
        $permissions = Permission::select('id', 'name')->get();
        return view('rolls.edit', compact('rolls', 'permissions', 'modules'));
    }
    



    
    

    // public function update( Request $request, Roll $roll)
    // {
         
    //     $roll->name = $request->input('name');
    //     $roll->save();

    // }

    public function update(Request $request, $id)
    {
        $roll = Roll::findOrFail($id);
        $roll->name = $request->input('name');
        $permissions = $request->input('permissions');
        $roll->permissions()->sync($permissions);
        $roll->save();
    
        return redirect()->route('rolls.index')->with('success', 'rolls updated successfully');
    }
    public function destroy(Roll $roll)
    {
        $roll->delete();
        return redirect()->route('rolls.index')->with('success', 'rolls deleted successfully');

    }

}
