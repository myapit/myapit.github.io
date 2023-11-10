# Laravel - simple CRUD (create, read, update, delete) example

### Table of contents

Step 1: Setup Laravel  
Step 2: Setup Database   
Step 3: Create Staff Model & Migration For CRUD  
Step 4: Create Staff Controller By Artisan Command  
Step 5: Create Routes  
Step 6: Create Blade Views File  
Step 7: Run Development Server  

---
\
**Step 1: Setup laravel**

First step, we download the laravel framework using php composer (https://getcomposer.org).
Make sure install composer tools first.

`composer create-project laravel/laravel laravel-crud-app`

\
\
**Step 2: Setup Database (MySQL/MariaDB)**

Setup database with our laravel app. Find the **.env** file in **laravel-crud-app** directory and setup database details as follows:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=database-name
DB_USERNAME=database-user-name
DB_PASSWORD=database-password
```
Replace database-name, database-user-name and database-password according to your database setup.

\
\
**Step 3: Create Staff Model & Migration For CRUD**

Open again your command prompt. And run the following command on it. To create model and migration file for form:

`php artisan make:model Staff -m`

After that, open Staff migration  file inside **laravel-crud-app/database/migrations/** directory. And then update the function up() with the following code:
```
public function up()
{
    Schema::create('staff', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email');
        $table->string('position');
        $table->string('address');
        $table->timestamps();
    });
}
```
*File : app/Models/Staff.php*

```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'position', 'address'];
}
```
Then, open again command prompt and run the following command to create tables in the database:

`php artisan migrate`
\
\
**Step 4: Create Staff Controller By Artisan Command**

Create a controller by using the following command on the command prompt to create a controller file:

`php artisan make:controller StaffController`

After that, visit ***app/Http/controllers*** and open the ***StaffController.php*** file. And update the following code into it:

```
<?php

namespace App\Http\Controllers;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $staffs = Staff::orderBy('id','desc')->paginate(5);
        return view('staffs.index', compact('staffs'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('staffs.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'position' => 'required',
            'address' => 'required',
        ]);
        
        Staff::create($request->post());

        return redirect()->route('staffs.index')->with('success','Staff has been created successfully.');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function show(Staff $Staff)
    {
        return view('staffs.show',compact('Staff'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function edit(Staff $Staff)
    {
        return view('staffs.edit',compact('Staff'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, Staff $Staff)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'position' => 'required',
            'address' => 'required',
        ]);
        
        $Staff->fill($request->post())->save();

        return redirect()->route('staffs.index')->with('success','Staff Has Been updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Staff  $Staff
    * @return \Illuminate\Http\Response
    */
    public function destroy(Staff $Staff)
    {
        $Staff->delete();
        return redirect()->route('staffs.index')->with('success','Staff has been deleted successfully');
    }
}
```
\
\
**Step 5: Create Routes**

Then create routes for laravel crud app. So, open the ***web.php*** file from the routes directory of laravel CRUD app. And update the following routes into the ***web.php*** file:

```
use App\Http\Controllers\StaffController;
 
Route::resource('staffs', StaffController::class);
```
\
\
**Step 6: Create Blade Views File**

Create the directory and some blade view, see the following:
```
    Make Directory Name 
    -staffs
    --index.blade.php
    --create.blade.php
    --edit.blade.php
```
Create directory name staffs inside the ***resources/views*** directory.

Note that, create ***index.blade.php***, ***create.blade.php***, and ***edit.blade.php*** inside the staffs directory. And update the following code into the following files:

*File : index.blade.php:*
```
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
```
\
*File: create.blade.php:*
```
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Staff Form - Laravel CRUD app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Staff</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('staffs.index') }}"> Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('staffs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Staff Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Staff Email">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Position:</strong>
                        <input type="text" name="position" class="form-control" placeholder="Staff Position">
                        @error('position')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Address:</strong>
                        <input type="text" name="address" class="form-control" placeholder="Staff Address">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
```
\
*File: edit.blade.php:*
```
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Staff Form - Laravel CRUD app</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Staff</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('staffs.index') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('staffs.update',$Staff->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Name:</strong>
                        <input type="text" name="name" value="{{ $Staff->name }}" class="form-control"
                            placeholder="Staff name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Staff Email"
                            value="{{ $Staff->email }}">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Position:</strong>
                        <input type="text" name="position" class="form-control" placeholder="Staff Position"
                            value="{{ $Staff->position }}">
                        @error('position')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Staff Address:</strong>
                        <input type="text" name="address" value="{{ $Staff->address }}" class="form-control"
                            placeholder="Staff Address">
                        @error('address')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary ml-3">Submit</button>
            </div>
        </form>
    </div>
</body>

</html>
```
If submit the add or edit form blank. So the error message will be displayed with the help of the code given below:
```
@error('name')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
```
\
\
Step 7: Run Development Server using php CLI

In the last step, open a command prompt and run the following command to start the development server:

`php artisan serve`

Then open your browser and hit the following URL on it:

`http://127.0.0.1:8000/staffs`

ThE EnD
--