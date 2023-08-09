<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <link rel="stylesheet"

    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome -->

<link rel="stylesheet" href="{{ url('plugins/fontawesome-free/css/all.min.css') }}">

<!-- Ionicons -->

<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

 

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

 

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

 
  {{-- @extends('admin-layouts.app') 
@include('admin-layouts.header')
@include('admin-layouts.sidebar') --}}


<style>

    .select2-container .select2-selection--single {

        height: 36px !important;

    }

</style>

</head>

<body>

    <form action="{{route('permissions.index')}}" method="get"> <!--It wii provide base URL -->

        <div class="card card-primary">

          <div class="card-header">

          <h3 class="card-title"> Filter</h3>

       

          </div>

         

           <!-- <pre>

            @php

            print_r($errors->all());

            @endphp

          </pre> -->

          <div class="row">

            <div class="col-6">

                <div class="card-body">

                    <div class="form-group col-md">

                        <label for="exampleInputName">Topic</label>

                        <select class="js-example-basic-single js-statesform-control" name="topic">

                            @foreach($permissions as $permission)
                            <option value="{{ $permission->id }}" {{ $selectedPermissionId == $permission->id ? 'selected' : '' }}>
                                {{ $permission->name }}
                            </option>
                        @endforeach
                        </select>

                    </div>

                </div>

            </div>

            <div class="col-6">

                <div class="card-body">

                    <div class="form-group col-md">

                        <label for="exampleInputName">Category</label>

                        <select class="js-example-basic-multiple js-statesform-control" name="permission_id">

                            <option value="">Select option<option>

                                @foreach($permissions as $permission)
                                <option value="{{ $permission->id }}" {{ $selectedPermissionId == $permission->id ? 'selected' : '' }}>
                                    {{ $permission->name }}
                                </option>
                            @endforeach

                        </select>

                    </div>

                </div>

            </div>

        </div>

                         

          <div class="card-footer">

          <button type="submit" class="btn btn-primary">Submit</button>

          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

          <a href="{{Request::url()}}" class="btn btn-primary">Clear</a>

          </div>

         

          </div>

        </form>

 

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>

  $(document).ready(function() {

    $('.js-example-basic-single').select2();

  });

</script>

</body>

</html>