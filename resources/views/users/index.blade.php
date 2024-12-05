

<h1>hiii</h1>
<a href="{{ route('users.create') }}" class="btn btn-success mb-3">Add User</a>
<a href="{{ route('users.export') }}" class="btn btn-primary mb-3">Export to CSV</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Profile Pic</th>
            <th>Actions</th>
        </tr>
    </thead>
    <?php
    // echo 'pre';
    // print_r($users);
    // die()
    ?>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->mobile }}</td>
                <td>
                    @if($user->profile_pic)
                        <img src="{{ asset('storage/' . $user->profile_pic) }}" alt="Profile" width="50">
                    @endif
                </td>
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


{{-- <h1>hiii</h1> --}}
