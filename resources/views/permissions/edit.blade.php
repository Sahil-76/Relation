<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Permission</title>
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

        <form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <center>
                <h1>Edit permissions</h1>
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
                <input type="text" name="name" id="name" required value="{{ $permission->name }}">
            </div>

            <div class="form-group">

                <label for="module">Module</label>

                <select name="module" id="module" class="form-control" placeholder="">

                    @foreach ($moduleList as $key => $value)

                        <option value="{{ $key }}"

                            @if (isset($permission) && $permission->module_id == $key) selected @endif>{{ $value }}

                        </option>

                    @endforeach

                </select>

            </div>
            
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-success" href="{{ route('permissions.index') }}"> Goto Index</a>
        </form>
    </div>
</body>

</html>
