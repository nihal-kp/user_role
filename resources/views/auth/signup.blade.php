@extends("layout.app")
@section("content")
<div class="container col-8 col-md-5 col-lg-5 center mt-4">
    <h2 class="mb-4">Register Now</h2>
    <form class="form-horizontal" action="{{ route('signup') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ old('name') }}" required>
            @error("name")
            <p style="color:red">{{$errors->first("name")}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email" value="{{ old('email') }}" required>
            @error("email")
            <p style="color:red">{{$errors->first("email")}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="password" value="{{ old('password') }}" required>
            @error("password")
            <p style="color:red">{{$errors->first("password")}}</p>
            @enderror
        </div>
        <div class="form-group">
            <label for="role">Select role:</label>
            <select class="form-control" name="role">
                <option value="owner" >Owner</option>
                <option value="admin">Admin</option>
                <option value="subscriber">Subscriber</option>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Signup</button>
    </form>
</div>
@endsection