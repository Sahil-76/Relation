<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Contracts\Auth\Access\Gate;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

  /*  public function index()
    {
            $data['permissions']=Permission::with('module')->simplePaginate(3);
            // In  this code fetches the permissions from the permissions model using the get() method.
            return view('permissions.index', $data);
            
            // $moduleList = Module::pluck('name', 'id');
            // return view('permissions.create', compact('moduleList'));

    }*/

// this is orignal controller
    // public function index(Request $request)
    // {
    //     $modules = Module::all();
    //     $query = Permission::with('module');

    
    //     if ($request->has('module_id') && $request->module_id != '') {
    //         $query->whereHas('module', function ($moduleQuery) use ($request) {
    //             $moduleQuery->where('id', $request->module_id);
    //         });

    //     }    
        
    //         $selectedPermissionId = $request->has('permission_id') ? $request->permission_id : null;
    //         if ($selectedPermissionId) {

    //             $query->wherein('id', $selectedPermissionId);
    //         }
    //     $permissions = $query->paginate(3);
    //     // $permission = Permission::pluck('name', 'id');
    
    //     return view('permissions.index', compact('permissions', 'modules', 'selectedPermissionId'));
    // }
    

// dataset


 // Import your Permission model at the top
 
 public function index(Request $request)
 {
     $modules = Module::all(); // Fetch modules
 
     if ($request->ajax()) {
         $query = Permission::with('module');
 
         // Apply filters if provided
         if ($request->has('module_id')) {
             $query->where('module_id', $request->get('module_id'));
         }
 
         // Apply permission filter if provided
         $selectedPermissionId = $request->has('permission_id') ? $request->permission_id : null;
                 if ($selectedPermissionId) {
     
                     $query->wherein('id', $selectedPermissionId);
                 }
             $permissions = $query->paginate(3);
             $permission = Permission::pluck('name', 'id');
         
         // You can add more filters here as needed
 
         $permissions = $query->get(); // Fetch filtered results
 
         return DataTables::of($permissions)
             ->addColumn('action', function ($permission) {
                 $buttons = '<a class="btn btn-primary" href="' . route('permissions.edit', $permission->id) . '">Edit</a>';
                 $buttons .= '<form action="' . route('permissions.destroy', $permission->id) . '" method="POST" style="display: inline;">';
                 $buttons .= csrf_field();
                 $buttons .= method_field('DELETE');
                 $buttons .= '<button type="submit" class="btn btn-danger">Delete</button>';
                 $buttons .= '</form>';
                 return $buttons;
             })
             ->rawColumns(['action'])
             ->make(true);
     }
 
     // Fetch and prepare data for non-AJAX rendering
     $permissionsQuery = Permission::with('module');
 
     // Apply filters if provided
     if ($request->has('module_id')) {
         $permissionsQuery->where('module_id', $request->get('module_id'));
     }
 
     // Apply permission filter if provided
     if ($request->has('permission_id')) {
         $permissionsQuery->where('id', $request->get('permission_id'));
     }
     // You can add more filters here as needed
 
     $permissions = $permissionsQuery->get();
 
     // Pass the $permissions and $modules variables to the view
     return view('permissions.index', compact('permissions', 'modules'));
 }
 

 



        

     

    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['moduleList']=Module::pluck('name','id');

        return view('permissions.create',$data);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $permission = new Permission();
        $permission->name = $request->input('name');
        $permission->module_id=$request->module;
        $permission->save();
        return redirect()->route('permissions.index')->with('success', 'permission created successfully');
    }

    /**
     * Display the specified resource.
     */

    public function show(Permission $permission)
    {
        //
        return view('permissions.show', compact('permission'));


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data['permission'] = Permission::findOrFail($id);
//this line is using for admin authentication
// $this->authorize('isAdmin', Permission::class);

if (!$this->authorize('isAdmin', Permission::class)) {
    abort( 'This action is not for you.');

}

        $permissions = Permission::findOrFail($id);
        
    
        $data['moduleList'] = Module::pluck('name', 'id');
        return view('permissions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request, $id)

    {

        $request->validate([
            'name'   => 'required',

        ]);
        $permission = Permission::findorfail($id);
        $permission->name   = $request->name;
        $permission->module_id = $request->module;
        $permission->save();
        //$permission->permissions()->sync($modules);
        return to_route('permissions.index')->with('success', 'Successfully update pemission data');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions.index')->with('success', 'permission deleted successfully');
    }
}
