<?php

namespace App\Http\Controllers;

use App\Models\Roll;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /*  public function index(Request $request)
    {
        $name = $request->input('search');
        // $rolls = Roll::all();
        $query = User::with('rolls', 'createdBy'); // Fix the relationship name 'rolls' to 'roles'
    
        if ($request->input('search')) { // Check if the 'search' parameter is present
            $query->where(function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            });
        }


        // Filter by selected role if provided
        // if ($request->has('roll_id') && $request->roll_id != '') {
        //     $query->where('roll_id', $request->roll_id);
        // }
    
        // Paginate the results
        $data['users'] = $query->simplePaginate(3);
    
        // Pass roles and selected role_id to the view
        // $data['rolls'] = $rolls;
        // $data['selectedRoleId'] = $request->input('roll_id');
    
        return view('users.index', $data);
    }*/


// my controller
   /* public function index(Request $request)
    {
         $query = User::with('rolls', 'createdBy');

        // Check if the 'search' parameter is present and filter users accordingly
        if ($request->has('search')) {
            $name = $request->input('search');
            $query->where(function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%')
                    ->orWhere('email', 'like', '%' . $name . '%');
            });
        }

        // Check if both 'dateFrom' and 'dateTo' parameters are present and filter users by date range
        if ($request->has('dateFrom') && $request->has('dateTo')) {
            $fromDate = $request->input('dateFrom');
            $toDate = $request->input('dateTo');
            $query->whereDate('created_at', '>=', $fromDate)
                ->whereDate('created_at', '<=', $toDate);
        }
        $users = $query->paginate(3);
        // Pass the filtered data to the view
        return view('users.index', compact('users', 'request'));
       
    }*/


// ankit sir 
//     public function index(Request $request)
// {
//     if ($request->ajax()) {
//         $users = User::query();

//         if ($request->has('user_id')) {
//             $users->whereIn('id', $request->get('user_id'));
//         }

//         return DataTables::of($users)
//             ->addColumn('permissions', function ($user) {
//                 return $user->permissions->implode('name', ',');
//             })
//             ->addColumn('action', function ($user) {
//                 $buttons = '<a class="btn btn-primary" href="' . route('users.edit', $user->id) . '">Edit</a>';
//                 $buttons .= '<form action="' . route('users.destroy', $user->id) . '" method="POST" style="display: inline;">
//                     ' . csrf_field() . '
//                     ' . method_field('DELETE') . '
//                     <button type="submit" class="btn btn-danger">Delete</button>
//                 </form>';
//                 return $buttons;
//             })
//             ->make(true);
//     }

//     return view('users.index');
// }


public function index(Request $request)
{
    if ($request->ajax()) {
        $query = User::with('rolls', 'createdBy');

        // Check if the 'search' parameter is present and filter users accordingly
        if ($request->has('search.value')) {
            $searchValue = $request->input('search.value');
            $query->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('email', 'like', '%' . $searchValue . '%');
            });
        }

        $selectedUserId = $request->has('users_id') ? $request->permission_id : null;
        if ($selectedUserId) {

            $query->wherein('id', $selectedUserId);
        }

        // Fetch data using the query and DataTables::of() function
        return DataTables::of($query)
            ->addColumn('rolls', function ($user) {
                return $user->rolls->implode('name', ', ');
            })
            ->addColumn('createdBy.name', function ($user) {
                return $user->createdBy->name;
            })
            ->addColumn('action', function ($user) {
                $buttons = '<a class="btn btn-primary" href="' . route('users.edit', $user->id) . '">Edit</a>';
                $buttons .= '<form action="' . route('users.destroy', $user->id) . '" method="POST" style="display: inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>';
                return $buttons;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    return view('users.index');
}










    // public function index(Request $request)
    // {
    //     $name = $request->input('search');

    //     $query = User::with('roles', 'createdBy'); // Fixed the relationship name 'rolls' to 'roles'

    //     if ($request->input('search')) { // Check if the 'search' parameter is present
    //         $query->where(function ($query) use ($name) {
    //             $query->where('name', 'like', '%' . $name . '%')
    //                 ->orWhere('email', 'like', '%' . $name . '%');
    //         });
    //     }

    //     $fromDate = $request->input('dateFrom');
    //     $toDate = $request->input('dateTo');

    //     if ($request->has('dateFrom') && $request->has('dateTo')) {
    //         $query->whereDate('created_at', '>=', $request->dateFrom)->whereDate('created_at', '<=', $request->dateTo);
    //     }

    //     // $data['users'] = $query->simplePaginate(3);

    //     $data['selectedRoleId'] = $request->input('user_id'); // Fixed the variable name 'roll_id' to 'role_id'

    //     return view('users.index', $data);
    // }





















    //     public function index(Request $request) {
    // $rolls=Roll::all();
    // $query=User::query();
    // $name = $request->has('name');
    // if ($request->has('name'))
    //     {
    //         $query->where('name', 'like', '%' . $name . '%'); // Paginate the results $users = $query->paginate(10);
    //        return view('users.index',compact('users','rolls'));
    //     }
    // }

    public function create()
    {
        //   $users= User::all();
        //   return view('users.create', compact('users'));



        return view('users.create');
    }



    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->created_by = Auth::id();
        $user->save();
        return redirect()->route('users.index')->with('success', 'Users created successfully');
    }

    public function show(User $user)
    {

        return view('users.show', compact('users'));
    }


    public function edit($id)
    {
        $users = User::findOrFail($id);
        $rolls = Roll::select('id', 'name')->get();
        return view('users.edit', compact('users', 'rolls'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $rolls = $request->input('rolls');
        $user->rolls()->sync($rolls); // Use parentheses to call the sync method on the rolls() relationship  . sync is use for upadate data pivot table 
        $user->save();
        return redirect()->route('users.index')->with('success', 'users updated successfully');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
