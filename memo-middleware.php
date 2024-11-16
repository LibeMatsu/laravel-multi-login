◆ app\Http\Middleware\Authenticate.php

※ 認証されていない場合にリダイレクトする処理を書く ※


namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Authenticate extends Middleware
{
protected $user_route = 'user.login';
protected $owner_route = 'owner.login';
protected $admin_route = 'admin.login';

// ↑ RouteServiceProviderで->as('user')とかしたやつ ↑

protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            if (Route::is('owner.*')) {
                return route($this->owner_route);
            } elseif (Route::is('admin.*')) {
                return route($this->admin_route);
            } else {
                return route($this->user_route);
            }
        }
    }

}