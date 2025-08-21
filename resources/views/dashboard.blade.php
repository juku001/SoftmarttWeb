@extends('layout.main')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-primary">Admin Dashboard</h2>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <!-- Add Admin Form -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                Add New Admin
            </div>
            <div class="card-body">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" name="mobile" id="mobile" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="sex" class="form-label">Sex</label>
                        <select name="sex" id="sex" class="form-select" required>
                            <option value="">Select sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </form>
            </div>
        </div>

        <!-- Admin List -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                Admin List
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Sex</th>
                            <th>DOB</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($admins as $index => $admin)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $admin['name'] }}</td>
                                <td>{{ $admin['email'] }}</td>
                                <td>{{ $admin['mobile'] }}</td>
                                <td>{{ $admin['sex'] }}</td>
                                <td>{{ $admin['dob'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
