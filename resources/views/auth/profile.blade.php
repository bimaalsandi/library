@if (Auth::user()->role == 'admin')
    @extends('layouts.main')
@else
    @extends('layouts.member')
@endif
@section('content')
    <div class="container my-4">
        <h4>Profile</h4>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Update Profile</h5>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('profile.update') }}" method="post">
                    @csrf
                    @method('put')
                    <div class="mb-3">
                        <label for="" class="form-label">Name</label>
                        <input type="text" name="name" id=""
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Email</label>
                        <input type="email" name="email" id=""
                            class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $user->email) }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>

            </div>


        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Change Password</h5>
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="{{ route('change.password') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Old Password</label>
                        <input type="password" name="old_password" id=""
                            class="form-control @error('old_password') is-invalid @enderror">
                        @error('old_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">New Password</label>
                        <input type="password" name="new_password" id=""
                            class="form-control @error('new_password') is-invalid @enderror">
                        @error('new_password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm New Password</label>
                        <input type="password" name="new_password_confirmation" id=""
                            class="form-control @error('new_password_confirmation') is-invalid @enderror">
                        @error('new_password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-outline-danger">Change Password</button>
                </form>

            </div>


        </div>
    </div>
@endsection
