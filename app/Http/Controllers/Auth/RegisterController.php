<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],

        // ADD THE CUSTOM RULE FOR THE ADDRESS FIELD
        'address' => ['required', 'string', 'max:255',
            function ($attribute, $value, $fail) {
                // Check if the address contains 'Kuala Lumpur' OR 'KL' (case-insensitive)
                if (stristr($value, 'Kuala Lumpur') === false && stristr($value, 'KL') === false) {
                    // If it doesn't contain either, fail the validation with a custom message.
                    $fail('Sorry, service is currently only available for addresses in Kuala Lumpur.');
                }
            },
        ],
    ]);
}
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
   
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
        ]);
    }
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    
   
}
