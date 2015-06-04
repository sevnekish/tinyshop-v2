<?

class SessionsHelper {
  /**
   * For Slim Middleware.
   * Redirect User to the login url if User not logged in.
   */
  public static function logged_in_user($app) {
    return function() use ($app) {
      if (!self::logged_in($app)) {
        self::store_location($app);
        $app->flash('messages', ['danger' => ['Please log in!']]);
        $app->redirect('/login');
      }
    };
  }

  /**
   * For Slim Middleware.
   * Redirect User to the root url if User logged in.
   */
  public static function not_logged_in_user($app) {
    return function() use ($app) {
      if (self::logged_in($app)) {
        $app->flash('messages', ['danger' => ['You are already logged in!']]);
        $app->redirect('/');
      }
    };
  }

  public static function correct_user($app, $id) {
      if (self::current_user($app)->id != $id) $app->redirect('/');
  }
  /**
   * Returns true if the user is logged in.
   */
  public static function logged_in($app) {
    if (self::current_user($app)) return true;
  }

  public static function current_user($app) {
    if (isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
      return $current_user = User::find($user_id);
    } elseif (null !== $app->getCookie('user_id')) {
      $user_id = $app->getCookie('user_id');
      $user = User::find($user_id);
      if ($user && $user->is_authenticated('remember', $app->getCookie('remember_token'))) {
        self::log_in($user);
        return $current_user = $user;
      }
    }
  }

  public static function is_current_user($app, $user) {
    return $user == self::current_user($app);
  }

  public static function is_activated($app, $user) {
    if (!$user->activated) {
      $app->flash('messages', ['warning' => ['Account not activated! Check your email for the activation link.']]);
      $app->redirect('/');
    }
  }

  public static function log_in($user) {
    $_SESSION['user_id'] = $user->id;
  }

  public static function log_out($app) {
    self::forget($app, self::current_user($app));
    unset($_SESSION['user_id']);
    $app->view()->setData('current_user', null);
  }

  public static function remember($app, $user) {
    $user->remember();
    $app->setCookie('user_id',        $user->id,              '1 year');
    $app->setCookie('remember_token', $user->remember_digest, '1 year');
  }

  public static function forget($app, $user) {
    $user->forget();
    $app ->deleteCookie('user_id');
    $app ->deleteCookie('remember_token');
  }

  public static function redirect_back_or($app, $redirect_url) {
    if (isset($_SESSION['forward_url'])) {
      $forward_url = $_SESSION['forward_url'];
      unset($_SESSION['forward_url']);
      $app->redirect($forward_url);
    } else
      $app->redirect($redirect_url);
  }

  public static function store_location($app) {
    $_SESSION['forward_url'] = $app->request()->getPathInfo();
  }
}