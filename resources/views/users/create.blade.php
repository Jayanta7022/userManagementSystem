
<div class="container">
    <h1>Create User</h1>
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required pattern="[a-zA-Z\s]+">
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Mobile</label>
            <input type="text" name="mobile" class="form-control" required pattern="[0-9]{10}">
        </div>
        <div class="form-group">
            <label>Profile Picture</label>
            <input type="file" name="profile_pic" class="form-control" accept=".png,.jpg,.jpeg">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
