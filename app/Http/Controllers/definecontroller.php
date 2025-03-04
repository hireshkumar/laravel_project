<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Student;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentMail;
use DB;

class DefineController extends Controller
{
    public function index(Request $request)
    {
        $states = State::all(); // Fetch states from database
        $name = "Register Form";
        return view("file", compact('name','states'));
    }

    public function register(Request $request)
    {
        $details = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        User::create($details);
        return redirect('/file')->with('success', 'Success');
    }

    public function student_data(Request $request)
    {
        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            request()->profile_photo->move(public_path('images'), $imageName);
        } else {
            $imageName = "";
        }
    
        $student = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'number' => $request->number,
            'gender' => $request->gender,
            'city' => $request->city,
            'state' => $request->state,
            'profile_photo' => $imageName,
        ];


        Student::create($student);
        // return redirect('/records')->with('success', 'Success');
        

                // Send Email
    //    Mail::to($request->email)->send(new StudentMail($details));
       Mail::to($request->email)->send(new StudentMail($student));


       return redirect('/records')->with('success', 'Student registered and email sent successfully!');
    }

    public function records()
    {
        $records = Student::orderBy('id','DESC')->paginate(5);
        return view('records', compact('records'));
    }

    public function delete_record($id)
    {
        Student::destroy($id);
        return back();
    }

    public function edit_record($id)
    {
        $data = Student::find($id);
        return view('edit_form', compact('data'));
    }

    public function update_data(Request $request, $id)
    {
        $data = Student::find($id);

        if ($request->hasFile('profile_photo')) {
            $image = $request->file('profile_photo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            request()->profile_photo->move(public_path('images'), $imageName);
        } else {
            $imageName = $data->profile_photo;
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'number' => $request->number,
            'gender' => $request->gender,
            'city' => $request->city,
            'state' => $request->state,
            'profile_photo' => $imageName,
        ];

        Student::where('id', $id)->update($updateData);
        return redirect('records');
    }

    public function toggleStatus($id)
    {
        $student = Student::findOrFail($id);
        $student->status = $student->status == 1 ? 0 : 1;
        $student->save();

        return redirect()->route('records')->with('success', 'Status updated successfully.');
    }

    // Method to load form with state dropdown
    // public function showForm(Request $request)
    // {
    //     $states = State::all(); // Fetch states from database
    //     return view("file", compact('states')); // Pass states to the view
    // }
    

    // Method to fetch cities based on selected state
    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->get();
        return response()->json($cities);

 
    }

}






