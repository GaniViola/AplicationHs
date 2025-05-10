@extends('admin.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow rounded-4 p-4">
          @if (session()->has('createsuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('createsuccess') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif
          <h4 class="mb-4">Create Account</h4>
          <form action="/CreateAccount" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
              <label for="InputUsername" class="form-label">Username</label>
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="InputUsername" name="username" value="{{ old('username') }}">
              @error('username')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="InputEmail" class="form-label">Email</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="InputEmail" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-6">
              <label for="inputAddress" class="form-label">Address</label>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="inputAddress" name="address" value="{{ old('address') }}">
              @error('address')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
                <label for="inputPhone" class="form-label">Phone</label>
                <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="inputPhone" name="phone" value="{{ old('phone') }}">
                @error('phone')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword4" name="password">
                @error('password')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="inputState" class="form-label">User Role</label>
                <select id="inputState" class="form-select @error('role') is-invalid @enderror" name="role">
                  <option selected">Choose Role...</option>
                  <option value="admin">Admin</option>
                  <option value="worker">Worker</option>
                </select>
                @error('role')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-md-6">
              <label for="confirmPassword" class="form-label">confirm password</label>
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="confirmPassword" name="password_confirmation">
              @error('password_confirmation')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="skills" class="form-label">Choose Skill</label>
              <select name="skills[]" id="skills" class="form-select @error('skills') is-invalid @enderror" multiple required>
                  @foreach ($services as $service)
                      <option value="{{ $service->id }}" {{ (collect(old('skills'))->contains($service->id)) ? 'selected' : '' }}>
                          {{ $service->name }}
                      </option>
                  @endforeach
              </select>
              @error('skills')
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>                   
            <div class="input-group mb-3">
                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="inputGroupFile02" name="photo">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                @error('photo')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Create Account</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection