<!DOCTYPE html>
<html>
<head>
    <title>Permission Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
</head>
<body>
    <div class="container">
        <div class="form-container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data"> 
                @csrf

                <h1 class="text-center">Permissions</h1>
                <hr>

                @if($errors->any())
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
                    <input type="text" name="name" id="name" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="module">Module:</label>
                    <select name="module" id="module" class="form-control">

                        @foreach ($moduleList as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success" href="{{ route('permissions.index') }}">Go to Index</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>




