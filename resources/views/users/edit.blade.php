<div class="container">
    <h1>Edit User</h1>
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control"
                   value="{{ old('name', $user->name) }}"
                   required
                   pattern="[a-zA-Z\s]+"
                   title="Name must contain only letters">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}"
                   required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control"
                   value="{{ old('mobile', $user->mobile) }}"
                   required
                   pattern="[0-9]{10}"
                   maxlength="10"
                   minlength="10"
                   title="Mobile must be 10 digits">
            @error('mobile')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Current Profile Picture</label>
            @if($user->profile_pic)
                <img src="{{ asset('storage/'.$user->profile_pic) }}"
                     alt="Profile Picture"
                     class="img-thumbnail"
                     width="150">
            @else
                <p>No profile picture uploaded</p>
            @endif
        </div>

        <div class="form-group">
            <label>Update Profile Picture</label>
            <input type="file" name="profile_pic"
                   class="form-control"
                   accept=".png,.jpg,.jpeg">
            @error('profile_pic')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Update Password (Optional)</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   placeholder="Leave blank if no change">
            <small class="form-text text-muted">
                Leave blank if you don't want to update the password
            </small>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
