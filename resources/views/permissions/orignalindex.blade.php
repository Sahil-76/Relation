@extends('admin-layouts.app')
@include('admin-layouts.header')
@include('admin-layouts.sidebar')

{{-- <link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}"> --}}
<!-- Ionicons -->
{{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}

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
        </ul>
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
    </div>
</nav>

<div class="container mt-2">
    <center>
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h1>permission Index Page</h1>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create Roles </a>
                    <a class="btn btn-success" href="{{ route('permissions.create') }}"> Back </a>
                </div>
            </div>
        </div>
    </center>

    <form action="{{ route('permissions.index') }}" method="get">

        <!--It will provide the base URL -->

        <div class="card card-primary">

            <div class="card-header">

                <h3 class="card-title">Module Filter</h3>

            </div>

        </div>

        <div class="container">

            <div class="row">

                <div class="col-lg-6">

                    <div class="card-body">

                        <div class="form-group col-md">

                            <label for="exampleInputName">Module name</label>
                            <select class="js-example-basic-single js-states form-control" name="module_id">
                                <option value="">All Module</option>
                                @foreach ($modules as $module)
                                    <option value="{{ $module->id }}"
                                        {{ request('module_id') == $module->id ? 'selected' : '' }}>
                                        {{ $module->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">

                    <div class="card-body">

                        <div class="form-group col-md">

                            <label for="exampleInputName">Permission</label>

                            {{-- <select class="js-example-basic-single js-states form-control" name="permission_id" mutiple> --}}
                            <select class="js-example-basic-multiple js-states form-control" name="permission_id[]"
                                multiple>
                                <option value="">All Permissions</option>
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->id }}"
                                        {{ $selectedPermissionId == $permission->id ? 'selected' : '' }}>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>

                            </select>
                        </div>
                    </div>
                </div>
                {{-- <select name="permission_id" class="js-example-basic-single form-contro form-control">
                    <option value="">All Permissions</option>
                    @foreach ($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ $selectedPermissionId && in_array($permission->id, $selectedPermissionId) ? 'selected' : '' }}>
                            {{ $permission->name }}
                        </option>
                    @endforeach

                </select> --}}


            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Search</button>
            <a href="{{ Request::url() }}" class="btn btn-primary">Clear</a>
        </div>
    </form>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    <table class="table table-bordered">
        <thead bgcolor="Powderblue">
            <tr>
                <th>S.No</th>
                <th>Name</th>
                <th>Module</th>
                <th width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($permissions as $permission)
                    <tr>
                    <td>{{ $permission->id }}</td>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->module->name ?? null }}</td>
                    @can('isAdmin', $permission)
                        <td>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('permissions.edit', $permission->id) }}">Edit</a>
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
    {{ $permissions->links() }}
</div>

<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script>
    //  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.js-example-basic-multiple').select2();

    //  });
</script>
@include('admin-layouts.footer')

