
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple HTML HomePage</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <link rel="stylesheet" href="css/style.css">

</head>

<body>
  <header class="header">
    <a href="#" class="logo">Developer</a>
    <nav class="nav-items">
      <a href="/">Home</a>
      <a href="/about">About</a>
      <a href="/contact">Contact</a>
    </nav>
  </header> 
  {{-- @include('pages.footer') --}}




















  
{{-- <h1>Header</h1> --}}
{{-- for using simple loop --}}
{{-- @foreach ($names as $n)
<p>{{$n}}</p> --}}

{{-- This is loop for key and value --}}

{{-- @foreach($names as $key => $value)
    <p>{{ $key }} - {{ $value }}</p>
@endforeach

@forelse ($names as $key => $value)
    <p>{{ $key }} - {{ $value }}</p>
@empty
    <p>No Values Found</p>
@endforelse --}}
{{-- {{$names}} --}}