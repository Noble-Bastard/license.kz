<?php

namespace App\Http\Controllers\Auth;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\ProfileExt;
use App\Data\Helper\ProfileStateTypeList;
use App\Data\Helper\RoleList;
use App\Http\Controllers\Controller;
use App\Rules\ReCaptcha;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/profile';

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
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        if(Input::has('personType')){
            switch(Input::get('personType')){
                case 'legal':
                    return view('auth.register_legal');
                case 'individual':
                    return view('auth.register');
            }
        }

        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        if($data["profile_state_type_id"] == ProfileStateTypeList::LegalPerson){
            return Validator::make($data, [
                'full_name' => 'required|string|max:255',
                'legal_address' => 'required|string|max:512',
                'director_name' => 'required|string|max:128',
                'bank_code' => 'required|string|max:128',
                'bank_code_type_id' => 'required|numeric',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'phone' => 'required|string',
                'business_identification_number' => 'required|string|max:16',
                'contact_person' => 'required|string|max:128',
                'position' => 'required|string|max:255',
                'scope_activity' => 'required|string|max:1024',
              'g-recaptcha-response' => ['required', new ReCaptcha]
            ]);
        } else {
            return Validator::make($data, [
                'full_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'phone' => 'required|string',
              'g-recaptcha-response' => ['required', new ReCaptcha]
            ]);
        }
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return $this->createUserAndProfile($data);
    }

    public function createUserAndProfile(array $data){
        $profileExt = new ProfileExt();
        $profileExt->full_name = $data["full_name"];
        $profileExt->phone = $data["phone"];
        $profileExt->email = $data["email"];
        $profileExt->password = $data["password"];
        $profileExt->profile_state_type_id = $data["profile_state_type_id"];
        $profileExt->is_resident = Arr::has($data, "is_resident");
        $profileExt->role_id = RoleList::Client;
        $profileExt->send_pass = Arr::has($data, "send_pass");

        if($data["profile_state_type_id"] == ProfileStateTypeList::LegalPerson) {
//            $profileExt->phone = $data["phone"];
            $profileExt->bank_code_type_id = $data["bank_code_type_id"];
            $profileExt->bank_code = $data["bank_code"];
            $profileExt->director_name = $data["director_name"];
            $profileExt->legal_address = $data["legal_address"];

            $profileExt->business_identification_number = $data["business_identification_number"];
            $profileExt->contact_person = $data["contact_person"];
            $profileExt->position = $data["position"];
            $profileExt->scope_activity = $data["scope_activity"];
        }

        return ProfileDal::insert($profileExt);
    }
}
