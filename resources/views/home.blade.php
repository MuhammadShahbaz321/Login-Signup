@extends('Layouts.app')
@section('content')

<h1>Home : {{ Auth::user()->name }}</h1>
<h2>This Page is access after login successfully ...!</h2>

@endsection
