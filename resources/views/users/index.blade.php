@include('admin-layouts.app')
@include('admin-layouts.sidebar')
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
                        <h1>Users Index Page</h1>
                    </div>
                    <div class="pull-right mb-2">
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Create User </a>
                        <a class="btn btn-success" href="{{ route('users.create') }}"> Back </a>
                    </div>
                </div>
            </div>
        </center>

      
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a>
        </div>
        
    <div class="container mt-2">
        <!-- ... (existing HTML code) ... -->
        <table class="table table-bordered" id="myTable">
            <thead bgcolor="Powderblue">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
        </table>
    </div>

 </body> 
   
 <script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('users.index') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'rolls', name: 'rolls.name', orderable: false }, // Assuming roles are fetched with users
                { data: 'createdBy.name', name: 'createdBy.name' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
 <script>
    //  $(document).ready(function() {
 
    $('.js-example-basic-multiple').select2();

    //  });
</script> 
 </html>
 {{-- @include('admin-layouts.footer') --}}

