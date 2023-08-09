
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <title>Edit Users</title>
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

                    <form action="{{ route('users.update', $users->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <center>
                            <h1>Edit </h1>
                            {<!DOCTYPE html>
                            <html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                                <title>Document</title>
                            </head>
                        
                            {rough}
                            {{5+4}}
                            @php
                                $names=["sahil", "ram","shyam"]
                            @endphp

                            <Ul>
                                @foreach ($names as $n)
                                @if($loop->even)
                                <li >{{$loop->index}}-{{$n}}</li>
                                <li style="color:#3c763d">{{$n}}</li>
                                
                                @endif
                                @endforeach
                            </Ul>


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
{{--      @if ($erro -> any ())   
    <div class  --}}
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" required value="{{ $users->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" required value="{{ $users->email }}">
                        </div>
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title">Assign Role</h3>
                            </div>
                            <div class="card-body">
                                    @foreach ($rolls as $roll)
                            <div class="form-group">
                            <label for="{{ $roll->name }}">{{ $roll->name }}</label>
                            <input type="checkbox" name="rolls[]" value="{{ $roll->id }}" {{ in_array($roll->id, $users->rolls->pluck('id')->toArray()) ? 'checked' : '' }}>

                            </div>
                                    @endforeach
                            </div>
                            </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
    </div>
</body>

</html>
