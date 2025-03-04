<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Student - Laravel 9 CRUD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left mb-2">
                    <h2>Add Student</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('records') }}">Back</a>
                </div>
            </div>
        </div>

        @if(session('status'))
            <div class="alert alert-success mt-2">
                {{ session('status') }}
            </div>
        @endif

        <form action="{{ url('student_data') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <!-- Name Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Student Name:</strong>
                        <input type="text" name="name" class="form-control" placeholder="Enter Student Name">
                        @error('name') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Email Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Student Email:</strong>
                        <input type="email" name="email" class="form-control" placeholder="Enter Student Email">
                        @error('email') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Password:</strong>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                        @error('password') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Phone Number -->
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>Phone Number:</strong>
                        <input type="tel" name="number" class="form-control" placeholder="Enter Phone Number">
                        @error('number') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Gender -->
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Gender:</strong><br>
                        <input type="radio" id="male" name="gender" value="male"> <label for="male">Male</label>
                        <input type="radio" id="female" name="gender" value="female"> <label for="female">Female</label>
                        <input type="radio" id="other" name="gender" value="other"> <label for="other">Other</label>
                        @error('gender') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- State Dropdown -->
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>State:</strong>
                        <select name="state" id="state" class="form-control">
                            <option value="">Select State</option>
                            @foreach($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @error('state') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- City Dropdown (Populated via AJAX) -->
                <div class="col-md-6">
                    <div class="form-group">
                        <strong>City:</strong>
                        <select name="city" id="city" class="form-control">
                            <option value="">Select City</option>
                        </select>
                        @error('city') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Profile Photo -->
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Profile Photo:</strong>
                        <input type="file" name="profile_photo" class="form-control-file">
                        @error('profile_photo') <div class="alert alert-danger mt-1">{{ $message }}</div> @enderror
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <!-- AJAX Script to Load Cities Based on Selected State -->
    <script>
        $(document).ready(function () {
            $('#state').on('change', function () {
                var state_id = this.value;
                
                $('#city').html('<option value="">Select City</option>'); 
                if (state_id) {
                    $.get("/get-cities/" + state_id, function(data) {
                        $.each(data, function (key, value) {
                            $('#city').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    });
                }
            });
        });
    </script>
</body>
</html>
