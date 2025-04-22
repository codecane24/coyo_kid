@extends('layout.mainlayout')

@section('content')
<div class="container">
    <h2>Edit Permission</h2>
    <form method="POST" action="{{ route('superadmin.permissions.update', $permission->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Permission Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $permission->name) }}">
            @error('name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <button class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
