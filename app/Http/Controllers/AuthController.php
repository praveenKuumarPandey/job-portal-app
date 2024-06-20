<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        $rememberMe = $request->filled('remember');


        if (Auth::attempt($credentials, $rememberMe)) {
            return redirect()->intended('/');

        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }

    }

    public function register()
    {

        $skills = Skill::all();
        return view('auth.register', ['skills' => $skills]);
    }

    public function saveUser(Request $request)
    {

        // dd($request);

        $validatedData = $request->validate([
            'name' => 'required|string|min: 3|max: 255',
            'email' => 'required|email',
            'password' => 'required',
            'skills' => 'required|array',
            'phone' => 'required|regex:/^[0-9]{10}$/',
            'address' => 'nullable|string| max: 500',
            'education_details' => 'nullable|string| max: 500',
        ]);

        // dd($request, $validatedData);
        $userdata = [...$validatedData, 'email_verified' => Carbon::now(), 'password' => Hash::make($request->password)];

        // $userdata = new User();
        // $userdata->name = $request->name;
        // $userdata->email = $request->email;
        // $userdata->password = Hash::make($request->password);
        // $userdata->save();
        // dd($request, $validatedData, $userdata);

        $result = User::create($userdata);

        // dd("user created", $result);


        if ($result) {
            $jobseekerCreateResult = $result->jobSeeker()->create([
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
                'education_details' => $validatedData['education_details'],
            ]);
            // dd("jobseeker created", $jobseekerCreateResult);
            if ($jobseekerCreateResult) {

                $skillAttached = $jobseekerCreateResult->skills()->attach($validatedData['skills']);
                return redirect('/auth/create')->with('success', 'Successfully registered');
            } else {
                return redirect()->back()->with('error', 'Some thing Went Wrong, Please Try Again');
            }

        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }


    }

    public function employerRegister()
    {


        return view('auth.employer-register');
    }


    public function saveEmployer(Request $request)
    {

        // dd($request);

        $validatedData = $request->validate([
            'name' => 'required|string|min: 3|max: 255',
            'email' => 'required|email',
            'password' => 'required',
            'company_name' => 'required',

        ]);

        // dd($request, $validatedData);
        $userdata = [...$validatedData, 'email_verified' => Carbon::now(), 'password' => Hash::make($request->password)];

        // $userdata = new User();
        // $userdata->name = $request->name;
        // $userdata->email = $request->email;
        // $userdata->password = Hash::make($request->password);
        // $userdata->save();
        // dd($request, $validatedData, $userdata);

        $result = User::create($userdata);

        // dd("user created", $result);


        if ($result) {
            $employerCreateResult = $result->employer()->create([
                'company_name' => $validatedData['company_name'],
            ]);
            // dd("jobseeker created", $jobseekerCreateResult);
            if ($employerCreateResult) {
                return redirect('/auth/create')->with('success', 'Successfully registered');
            } else {
                return redirect()->back()->with('error', 'Some thing Went Wrong, Please Try Again');
            }

        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }


    }

    public function destroy()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }
}
