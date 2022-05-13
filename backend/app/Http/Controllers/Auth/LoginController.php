<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;//ログインユーザー情報を取得したいから追記

use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * 外部サービスの認証ページへリダイレクトする。
     */
    public function redirectToProvider() {
        return Socialite::driver('line')->redirect();

        // $nonce_token = Str::random(40);

        // return Socialite::driver('line')
        //     ->setScopes(['openid', 'profile'])
        //     ->with([
        //         'nonce' => $nonce_token,
        //     ])
        //     ->redirect();

        //dd('redirectToProvider発火');
        //return redirect('https://access.line.me/oauth2/v2.1/authorize?client_id=1657113440&redirect_uri='.url('').'/login/line/callback&scope=openid+profile+email&response_type=code&state=PTYXTg9MCLgnTF5Y20fKvgyI98YxE7NXTzbgbOzg');
        //return Socialite::driver('line')->redirect();
    }

    public function loggedin(){
        return Socialite::driver('line')->user();
        dd('ログイン済みです。');
    }

    /**
     * 外部サービスからユーザー情報を取得し、ログインする。
     */
    public function handleProviderCallback(Request $request) {
        $hiragana = ["ぁ","あ","ぃ","い","ぅ","う","ぇ","え","ぉ","お",
        "か","が","き","ぎ","く","ぐ","け","げ","こ","ご",
        "さ","ざ","し","じ","す","ず","せ","ぜ","そ","ぞ",
        "た","だ","ち","ぢ","っ","つ","づ","て","で","と","ど",
        "な","に","ぬ","ね","の","は","ば","ぱ",
        "ひ","び","ぴ","ふ","ぶ","ぷ","へ","べ","ぺ","ほ","ぼ","ぽ",
        "ま","み","む","め","も","ゃ","や","ゅ","ゆ","ょ","よ",
        "ら","り","る","れ","ろ","わ","を","ん"];
        $r_str = null;
        for ($i = 0; $i < 5; $i++) {
            $r_str .= $hiragana[rand(0, count($hiragana) - 1)];
        }    
        
        $line_user = Socialite::driver('line')->stateless()->user();//->stateless()を追記
        $user = User::firstOrCreate(
            ['line_user_id' => $line_user->id],
            ['name' => $r_str],
        );

        //$this->guard()->login($user, true);//ログイン状態にしてしまうと再アクセス時に別ページに飛ばされるのでコメントアウト
        return $user;//api化したのでユーザー情報を返して終わり（jsonに変換必要←たぶんなってるんちゃう？）

        //api化したので下記は不要
        //return $this->sendLoginResponse($request);
    }
}