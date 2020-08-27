<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\User;
use App\Role;
use App\Contact;
use App\Permission;
use App\Store;
use App\Category;
use App\Product;
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
        $this->middleware('role:admin,user');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        if (in_array('admin', Auth::user()->roles->pluck('slug')->toArray())):
            $roles = Role::count();
            $users = User::count();
            $contacts = Contact::count();
            $permissions = Permission::count();
            $stores = Store::count();
            $categories = Category::count();
            $products = Product::count();
            return view(
                'adminhome', 
                [
                    'timenow' => Carbon::now()->toFormattedDateString(),
                    'users' => $users, 
                    'roles' => $roles, 
                    'contacts' => $contacts, 
                    'permissions' => $permissions,
                    'stores' => $stores,
                    'categories' => $categories,
                    'products' => $products,
                ]
            );  
        else:
            $contacts = Contact::where('user_id', Auth::user()->id)->orderByDesc('id')->count();
            $products = Product::where('user_id', Auth::user()->id)->orderByDesc('id')->count();
            $store = Store::where('user_id', Auth::user()->id)->orderByDesc('id')->get()->first();
            $categories = Category::where('user_id', Auth::user()->id)->orderByDesc('id')->count();
            return view(
                'userhome',
                [
                    'contacts' => $contacts,
                    'products' => $products,
                    'store' => (!empty($store) ? $store->store_name : ''),
                    'categories' => $categories,
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
