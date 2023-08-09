
@extends('admin-layouts.app')

@include('admin-layouts.header')

@include('admin-layouts.sidebar')

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="container">

        <a class="navbar-brand" href="{{ route('users.index') }}">
            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
        </a>

        <!-- Hamburger Button -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Settings Dropdown -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    <div class="row">
        <div class="col-md-6">
            <form action="" method="GET" class="form-inline">
                <div class="form-group col-lg-6">
                    <input type="search" name="search" class="form-control" placeholder="Search by name & email">
                   
                    {{-- <button type="submit" class="btn btn-primary">Search </button>
                    <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a> --}}
                    <div class="card-footer">

                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="submit" class="btn btn-primary">Search </button>
                        <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a>
        
                    </div>
                </div>
                {{-- <button type="submit" class="btn btn-primary">Search</button> --}}
            </form>
        </div>
        <div classs="col-md-6">
            <form action="" method="get" class="form-inline md-form mr-auto mb-4">
                {{-- <div class="col-6"> --}}
                    <button type="button" class="btn btn-sm btn-primary mt-3 ml-5" name="daterange" id="lastLoginDate-btn"
                        value="Select Date">
                        @if (!empty(request()->dateFrom) && !empty(request()->dateTo))
                            <span>
                                {{ Carbon\Carbon::parse(request()->get('dateFrom'))->format('d/m/Y') }}

                                {{--  this  is a popular date and time manipulation library in PHP. The parse() method of the Carbon class is used to parse the date string retrieved from dateFrom into a Carbon instance.  --}}
                                -
                                {{ Carbon\Carbon::parse(request()->get('dateTo'))->format('d/m/Y') }}
                            </span>
                        @else
                            <span>
                                <i class="fa fa-calendar"></i> &nbsp;Select Date&nbsp;
                            </span>
                            
                        @endif
                        <i class="fa fa-caret-down"></i>
                    </button>
                    {{ Form::hidden('dateFrom', request()->dateFrom ?? null, ['id' => 'dateFrom']) }}
                    {{ Form::hidden('dateTo', request()->dateTo ?? null, ['id' => 'dateTo']) }}
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i> Search
                    </button>
                    {{-- <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a> --}}
                {{-- </div> --}}
            </form>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <center>
                    <h2>User</h2>
                </center>
            </div>
            <div class="pull-right mb-2">
                <center>
                    <a class="btn btn-success" href="{{ route('users.create') }}"> Create User</a>
                </center>
            </div>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered" id="datatable">
        <thead>
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
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rolls->implode('name', ', ') }}</td>
                    <td>{{ $user->createdBy->name ?? null }}</td>
                    <td>{{ date_format($user->created_at, 'Y-m-d') }}</td>
                    <td>
                        <form action="{{ route('users.destroy', $user->id) }}" method="Post">
                            <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}">Edit</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $users->links() }}
</div>

{{-- Date filter cdn --}}

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!---daterangepicker js-->

<!-- DataTables JavaScript -->






<!-- Moment.js -->

<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- DateRangePicker JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/daterangepicker@3.1.0/daterangepicker.min.js"></script>
<script>
    $('#lastLoginDate-btn').daterangepicker({
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            ranges: {
                'Today': [moment(), moment()],
                'Tomorrow': [moment().add(1, 'days'), moment().add(1, 'days')],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 5 Days': [moment().subtract(4, 'days'), moment()],

            },
            startDate: moment(),
            endDate: moment()
        },
        function(start, end) {
            $('#lastLoginDate-btn span').html(start.format('D/ M/ YY') + ' - ' + end.format('D/ M/ YY'))
            $('#dateFrom').val(start.format('YYYY-M-DD'));
            $('#dateTo').val(end.format('YYYY-M-DD'));
        }
    );;
    $('#lastLoginDate-btn').on('cancel.daterangepicker', function(ev, picker) {
        clearDateFilters('lastLoginDate-btn', 'date');
    });

    function clearDateFilters(id, inputId) {
        $('#' + id + ' span').html('<span> <i class="fa fa-calendar"></i>  &nbsp;Select Date&nbsp;</span>')
        $('#' + inputId + 'From').val('');
        $('#' + inputId + 'To').val('');
    }
</script>

{{-- <script>
    $(document).ready(function(){
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            //order: [[ 0, "desc" ]],
            ajax: {

                url: "{{ route('users.index',$query) }}",

                type: "GET",
            },
                    
            columns: [

                { data: 'id', name: 'id' },

                { data: 'name', name: 'name' },

                { data: 'email', name: 'email' },

                 { data: 'created_by', name: 'created_by' },

                { data: 'created_at', name: 'created_at'},
            ]
        });
    }); --}}


{{-- 
    <script type="text/javascript">
        $(function () {
          
          var table = $('.data-table').DataTable({
              processing: true,
              serverSide: true,
              ajax: "{{ route('users.index') }}",
              columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                  {data:'id',id:'id'},
                  {data: 'name', name: 'name'},
                  {data: 'email', name: 'email'},
                  {data: 'action', name: 'action', orderable: false, searchable: false},
              ]
          });
          
        }); --}}

// <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
{{-- <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}


@include('admin-layouts.footer')

</body>

</html>