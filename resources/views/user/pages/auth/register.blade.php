@extends('user.layouts.master')

@section('title')
{{ $title??'Register' }}
@endsection

@section('content')

<div class=" formdiv">
          <form action="{{route('register-user')}}" method="POST">
                    @csrf

                    <h1>User Register</h1>
                    <hr>

                    <label for="username"><b>User Name</b></label>
                    <input type="text" placeholder="Enter User Name" name="name" id="username" required>

                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="Enter Email" name="email" id="email" required>

                    <label for="psw"><b>Password</b></label>
                    <input type="password" placeholder="Enter Password" name="password" id="password" required>

                    <button type="submit" class="actionbtn">Register</button>

                    <p>Already have an account? <a href="{{url('/login')}}">Sign in</a>.</p>

          </form>

</div>

@endsection