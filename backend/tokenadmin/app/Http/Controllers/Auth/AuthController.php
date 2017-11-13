<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserLog;
use App\Models\Role;
use App\Models\Company;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    
    /**
     * Where to redirect users after logout
     *
     * @var string
     */
    protected $redirectAfterLogout = '/';
    protected $loginView = 'auth.login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'getLogout']);
    }
    
    
    /**
     * Where to redirect users after Login/Registration
     *
     * @var string
     */
    public function redirectPath() {
        
        UserLog::create([
            'user_id' => \Auth::user()->user_id,
            'login_time' => \DB::raw('NOW()'),
            'ip_address' => \Request::ip()
        ]);
        
        return '/admin/dashboard';
    }
    
    public function getRegister() {
        return view('auth.register');
    }
    
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, User::$RegistrationRules, User::$RegistrationMessages, User::$RegistrationCustomAttributeNames);
    }

    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        
        $companyId = '';
        $roleId = Role::getRole(Role::ROLE_USER)->role_id;

        $oCompany = Company::where('name', $data['company_name'])->first();

        if($oCompany){
            $companyId = $oCompany->company_id;
        }else{
            $companyId = Company::where('name', 'MUC')->value('company_id');
        }

        $oUser = User::create([
            'company_id' => $companyId,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'contact_number' => $data['contact_number'],
            'password' => \Hash::make($data['password']),
            'company_at_register' => $data['company_name'],
        ]);
        
        if($oUser){
            $oUser->roles()->attach($roleId);
        }
        
        return $oUser;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                    $request, $validator
            );
        }

        $oUser = $this->create($request->all());
        
        if($oUser){
            
            \Session::flash('status', trans('notifications.success'));
            \Session::flash('message', trans('notifications.user.register_success'));

            return redirect()->route('auth.register');
            
        }else{
            \Session::flash('status', trans('notifications.error'));
            \Session::flash('message', trans('notifications.user.register_failure'));
            
        }
        
    }
    
    
    /* Start of Custom Login Script FrontEnd */

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postLoginAuth(Request $request) {
        return $this->loginAuth($request);
    }

    public function getCredentials($request)
    {
        $credentials = $request->only($this->loginUsername(), 'password');
        return array_add($credentials, 'status', User::STATUS_ACTIVE);
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginAuth(Request $request) {
        $this->validateLoginAuth($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        $throttles = $this->isUsingThrottlesLoginsTrait();

        if ($throttles && $lockedOut = $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $credentials = $this->getCredentials($request);

        if (Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticatedAuth($request, $throttles);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        if ($throttles && !$lockedOut) {
            $this->incrementLoginAttempts($request);
        }
        if ($request->ajax()) {
            return response()->json(['error' => 'Invalid Email or Password'], 400);
        }
        return redirect()->back()
                        ->withInput($request->only($this->loginUsername(), 'remember'))
                        ->withErrors([
                            'invalid_details' => $this->getFailedLoginMessage(),
        ]);
    }
    
    protected function handleUserWasAuthenticatedAuth(Request $request, $throttles) {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::guard($this->getGuard())->user());
        }

        if ($request->ajax()) {
            $_SESSION['user_name'] = Auth::user()->first_name . " " . Auth::user()->last_name;
            $_SESSION['user_id'] = Auth::user()->user_id;
            return response()->json([], 200);
        }
        return redirect()->intended($this->redirectPath());
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLoginAuth(Request $request) {
        $messages = [
            'required' => ':attribute is required.',
            'email' => 'Enter valid email',
        ];

        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
                ], $messages);
    }
    
     /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout() {
        $redirect_url = @$_SERVER['HTTP_REFERER'] ? @$_SERVER['HTTP_REFERER'] : '/';
        
        if (\Auth::check()) {
            $oUserLog = \Auth::user()->logs->last();
            if ($oUserLog) {
                $oUserLog->logout_time = \DB::raw('NOW()');
                $oUserLog->save();
            }
            
            \Auth::logout();
        }
        
        return redirect('/admin/login');
    }
    
    
}
