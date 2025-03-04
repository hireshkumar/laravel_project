<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laravel 9 CRUD Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
<div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Student Dashboard  {{Session::get('uid');}}</h2>
                </div>
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('file') }}"> Create Student</a>
                    <a class="btn btn-danger" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>

      
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Student Name</th>
                    <th>Student Email</th>
                    <!-- <th>Student Password</th> -->
                    <th>Student Number</th>
                    <th>Student Gender</th>
                    <th>Student City</th>
                    <th>Student State</th>
                    <th>Student Profile_photo</th>
                    <th width="280px">Action</th>
                    <th>Student Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($records as $student)
                    <tr>
                        <td>{{ $loop->iteration}}</td>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <!-- <td>{{ $student->password }}</td> -->
                        <td>{{ $student->number }}</td>
                        <td>{{ $student->gender }}</td>
                        <td>{{ $student->city }}</td>
                        <td>{{ $student->state }}</td>
                        <td>
                            @if(empty($student->profile_photo))
                            <img src="images/dummy-user.png" class="rounded-circle"
                            width="50" height="50" /> 
                            @else

                            <img src="images/{{ $student->profile_photo }}" class="rounded-circle"
                            width="50" height="50" />
                            @endif

                        </td>
                        <td>
                            <a href="{{ url('edit_record',$student->id) }}" class="btn btn-success mx-2"><i class="fa fa-edit"></i> </a>
                            <a href="{{ url('delete_record', $student->id) }}" class="btn btn-danger mx-1"><i class="fa fa-trash"></i></a>  
                            
                            <form action="{{ url('records'.$student->id) }}" method="post">
                                @csrf
                                @method('delete')
                             
                            </form>    
                            

                        </td>

                        <td>
                            
                            @if($student->status == 1)
                            <a href="{{ route('toggle_status', $student->id) }}" class="btn btn-success">Active</a>
                         @else
                            <a href="{{ route('toggle_status', $student->id) }}" class="btn btn-danger">Deactive</a>
                         @endif

                             
                        </td>

                    </td>

                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $records->links() !!}
    </div>
</body>
</html>
