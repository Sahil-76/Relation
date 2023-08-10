
 <!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="container">
            <a class="navbar-brand" href="{{ route('users.index') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
            </a>
            <!-- Hamburger Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-2">
        <center>
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h1>Rolls Index Page</h1>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('rolls.create') }}"> Create Roles </a>
                        <a class="btn btn-success" href="{{ route('rolls.create') }}"> Back </a>
                    </div>
                </div>
            </div>
        </center>

        <form action="{{ route('rolls.index') }}" method="get">

            <!--It will provide the base URL -->
    
            <div class="card card-primary">
    
                <div class="card-header">
    
                    <h3 class="card-title">Rolls DataTables</h3>
    
                </div>
    
            </div>
    
            <div class="container">
    
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-body">
                            <div class="form-group col-md">
                                <label for="exampleInputName">Roles</label>
                                <select class="js-example-basic-single form-control" name="roll_id">
                                    <option value="">All Rolls</option>
                                    @foreach ($rolls as $roll)
                                        <option value="{{ $roll->id }}" 
                                            {{ isset($selectedRollId) && $selectedRollId == $roll->id ? 'selected' : '' }}>
                                            {{ $roll->name }}
                                        </option>
                                    @endforeach
                                </select>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a>
        </div>
    </form>
    
    <div class="container mt-2">
        <!-- ... (existing HTML code) ... -->
        <table class="table table-bordered" id="myTable">
            <thead bgcolor="Powderblue">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
        </table>
        @php 
       $query=http_build_query(request()->query());
        @endphp
    </div>

</body>
   
{{-- <script type="text/javascript"> --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function() {

            $('#myTable').DataTable({

                processing: true,

                serverSide: true,

                ajax: '{!! route('rolls.index',$query) !!}', // The URL for the AJAX request


            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'permissions', name: 'permissions' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>


</html> 


// <<--this is the orignal index file-->>
{{-- @extends('admin-layouts.app')
@include('admin-layouts.header')
@include('admin-layouts.sidebar')

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="container">
        <a class="navbar-brand" href="{{ route('users.index') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>
        <!-- Hamburger Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-2">
    <center>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1>Rolls Index Page</h1>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('rolls.create') }}">Create Roll</a>
                    <a class="btn btn-success" href="{{ route('rolls.index') }}">Back</a>
                </div>
            </div>
        </div>
    </center>
    <form action="{{ route('rolls.index') }}" method="get">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Role Filter</h3>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card-body">
                        <div class="form-group col-md">
                            <label for="exampleInputName">Role name</label>
                            <select class="js-example-basic-single js-states form-control" name="roll_id">
                                <option value="">All Roles</option>
                                @foreach ($rolls as $roll)
                                    <option value="{{ $roll->id }}" {{ request('roll_id') == $roll->id ? 'selected' : '' }}>
                                        {{ $roll->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ route('rolls.index') }}" class="btn btn-primary">Clear</a>
                </div>
            </div>
        </div>
    </form>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered" id="myTable">
        <thead bgcolor="Powderblue">
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Permissions</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rolls as $roll)
                <tr>
                    <td>{{ $roll->id }}</td>
                    <td>{{ $roll->name }}</td>
                    <td>{{ $roll->permissions->implode('name', ',') }}</td>
                    @can('isAdmin')
                        <td>
                            <form action="{{ route('rolls.destroy', $roll->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('rolls.edit', $roll->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


@include('admin-layouts.footer')--}









 --}}



 {{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rolls Index</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Rolls Index</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('rolls.create') }}" class="btn btn-primary">Create Roll</a>
                <a href="{{ route('rolls.create') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="" method="get">
                    <div class="form-group">
                        <label for="roll_id">Role name</label>
                        <select class="form-control" name="roll_id">
                            <option value="">All Roles</option>
                            @foreach ($rolls as $roll)
                                <option value="{{ $roll->id }}"
                                    {{ request('roll_id') == $roll->id ? 'selected' : '' }}>
                                    {{ $roll->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <button type="submit" class="btn btn-primary">Search</button>
                    <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a> --}}
                {{-- </form>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Permissions</th>
                    <th>Action</th>
                </tr>
            </thead> --}}
            {{-- <tbody>
                @foreach ($rolls as $roll)
                    <tr>
                        <td>{{ $roll->id }}</td>
                        <td>{{ $roll->name }}</td>
                        <td>{{ $roll->permissions->implode('name', ',') }}</td>
                        @can('isAdmin')
                            <td>
                                <form action="{{ route('rolls.destroy', $roll->id) }}" method="POST">
                                    <button type="button" class="btn btn-primary"><a href="{{ route('rolls.edit', $roll->id) }}">Edit</a></button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
            </tbody>--}}
        {{-- </table>
        <script type="text/javascript">
            $(function () {
              
              var table = $('.data-table').DataTable({
                  processing: true,
                  serverSide: true,
                  ajax: "{{ route('users.index') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data:'s.no' , name:'s.no'}
                      {data: 'name', name: 'name'},
                      {data: 'permissions', name: 'permissions'},
                      {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
              });
              
            });
          </script> --}}

    {{-- </div>
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> 
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


</body>
</html> --}}

