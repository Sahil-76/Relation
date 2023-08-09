<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Rolls</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        @if (session('success'))
            <div class="alert alert-success mb-1 mt-1"
                style="background-color: #dff0d8; border-color: #d0e9c6; color: #3c763d;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('rolls.update', $rolls->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <center>
                <h1>Edit Rolls</h1>
            </center>
            <hr>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" required value="{{ $rolls->name }}">
            </div>


            {{-- 

            <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Assign Role</h3>
                </div>
                <div class="card-body">
                        @foreach ($permissions as $permission)
                <div class="form-group">
                <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" {{ in_array($permission->id, $rolls->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>

                </div>
                        @endforeach
                </div> --}}



            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Assign Role</h3>
                </div>
                <div class="form-group"><label for="permissions">permissions</label>


                    @foreach ($modules as $module)
                        <h5>{{ $module->name }} </h5>
                        @foreach ($module->permissions as $permission)
                            <div>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                                        {{ $rolls->permissions->contains('id', $permission->id) ? 'checked' : '' }}>
                                    {{ $permission->name }}
                                </label>
                            </div>
                        @endforeach
                    @endforeach
                </div>



                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
