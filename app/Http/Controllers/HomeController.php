<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Contact;
use App\Permission;
use App\Store;
use App\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller {

    CONST OPEN_WEATHER_MAP_API_URL = 'http://api.openweathermap.org/data/2.5/weather?q=';
    CONST OPEN_WEATHER_MAP_API_KEY = 'f30531db44404c8fb651f681a44f73da';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        if (in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
            $roles = Role::get();
            $users = User::get();
            $contacts = Contact::get();
            $permissions = Permission::get();
            $stores = Store::get();
            $categories = Category::get();
            return view(
                'adminhome', 
                [
                    'timenow' => Carbon::now()->toFormattedDateString(),
                    'users' => count($users), 
                    'roles' => count($roles), 
                    'contacts' => count($contacts), 
                    'permissions' => count($permissions),
                    'stores' => count($stores),
                    'categories' => count($categories),
                ]
            );  
        else:
            $contacts = Contact::where('user_id', Auth::user()->id)->orderByDesc('id')->get();;
            $store = Store::where('user_id', Auth::user()->id)->orderByDesc('id')->get()->first();
            $categories = Category::where('user_id', Auth::user()->id)->orderByDesc('id')->get();
            return view(
                'userhome',
                [
                    'contacts' => count($contacts),
                    'store' => (!empty($store) ? $store->store_name : ''),
                    'categories' => count($categories),
                ]
            );
        endif;
    }

    /**
     * Show the application dashboard.
     *
     * @return JSON object
     */
    public function getWeatherData($city = 'pune', $state = 'MH', $country = 'IN') {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', self::OPEN_WEATHER_MAP_API_URL . $city . ',' . $state . ',' . $country . '&appid=' . self::OPEN_WEATHER_MAP_API_KEY);
        return $response->getBody()->getContents();
    }

}
