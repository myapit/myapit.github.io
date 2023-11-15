<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel CRUD app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Laravel CRUD app</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('staffs.create') }}"> Create Staff</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Staff Name</th>
                    <th>Staff Email</th>
                    <th>Staff Address</th>
                    <th width="280px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staffs as $Staff)
                    <tr>
                        <td>{{ $Staff->id }}</td>
                        <td>{{ $Staff->name }}</td>
                        <td>{{ $Staff->email }}</td>
                        <td>{{ $Staff->position }}</td>
                        <td>{{ $Staff->address }}</td>
                        <td>
                            <form action="{{ route('staffs.destroy',$Staff->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('staffs.edit',$Staff->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $staffs->links() !!}
    </div>
</body>
</html>
