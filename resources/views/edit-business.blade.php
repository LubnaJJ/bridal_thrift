@extends('layouts.basic')

@section('content')
    <h1>Edit Business</h1>

    <form action="{{ route('business.update', $business->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="business_name" value="{{ $business->business_name }}" required>
        <input type="email" name="email" value="{{ $business->email }}" required>
        <input type="text" name="address" value="{{ $business->address }}" required>
        <input type="text" name="phone_number" value="{{ $business->phone_number }}" required>
        <input type="text" name="username" value="{{ $business->username }}" required>
        <input type="password" name="password" placeholder="Leave blank to keep current password">
        <button type="submit">Update Business</button>
    </form>
@endsection
