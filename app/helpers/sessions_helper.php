<?

class SessionsHelper {
  /**
   * Redirect User to the root_url if User logged in.
   */
  public static function not_logged_in($app) {
    if (self::logged_in($app)) {
      $app->flash('danger', ['You are already logged in.']);
      $app->redirect('/');
    }
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
    $app->setCookie('user_id',        $user->id,             '1 year');
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
    $_SESSION['forwarding_url'] = $app->request()->getPathInfo();
  }


  // Refactoring:
  // rename to authenticate
  // access_denied + authentication = one method

  // $authentication = function($app, $user, $authentication_role) {
  //   return function() use ($app, $user, $authentication_role) {
  //     $user_role = $user->getRole();
  //     if ($authentication_role != $user_role) {
  //       switch($user_role){
  //         case 'admin': $app->redirect("/adminbar"); break;
  //         case 'user': $app->redirect("/account"); break;
  //         case 'guest': 
  //           $app->flash('error', 'Login required');
  //           $app->setCookie('urlRedirect', $app->request()->getPathInfo(), '4 minutes');
  //           $app->redirect("/login");
  //           break;
  //         }
  //     }
  //   };
  // };

  // $access_denied = function($app, $user, $denied_user_role) {
  //   return function() use ($app, $user, $denied_user_role) {
  //     $user_role = $user->getRole();
  //     if ($denied_user_role == $user_role) {
  //       switch($denied_user_role){
  //         case 'admin': $app->redirect("/adminbar"); break;
  //         case 'user': $app->redirect("/account"); break;
  //         case 'guest': 
  //           $app->flash('error', 'Login required');
  //           $app->setCookie('urlRedirect', $app->request()->getPathInfo(), '4 minutes');
  //           $app->redirect("/login");
  //           break;
  //         }
  //     }
  //   };
  // };
}

