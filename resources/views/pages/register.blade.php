@extends('layouts.auth')

@section('content')
    <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
        <form class="card-body" method="POST" action="/register">
            @csrf
            <div class="form-control">
                <label for="name" class="label">
                    <span class="label-text">Name</span>
                </label>
                <input type="text" name="name" id="name" placeholder="name"
                       value="{{ old('name') }}"
                       class="input {{$errors->has('name') ? 'input-error' : ''}} input-bordered"
                       required />
                @error('name')
                <div class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="form-control">
                <label for="email" class="label">
                    <span class="label-text">Email</span>
                </label>
                <input type="email" name="email" id="email" placeholder="email"
                       value="{{ old('email') }}"
                       class="input {{$errors->has('email') ? 'input-error' : ''}} input-bordered"
                       required />
                @error('email')
                <div class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="form-control">
                <label class="label" for="password">
                    <span class="label-text">Password</span>
                </label>
                <input type="password" name="password" id="password" placeholder="password"
                       class="input {{$errors->has('password') ? 'input-error' : ''}} input-bordered"
                       required />
                @error('password')
                <div class="label">
                    <span class="label-text-alt text-error">{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div class="form-control mt-6">
                <button class="btn bg-lime-600 hover:bg-lime-700 text-white rounded-none">Register</button>
            </div>
        </form>
    </div>
@endsection
