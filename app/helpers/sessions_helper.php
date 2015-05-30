<?

/**
 * Redirect User to the root_url if User logged in.
 */
function not_logged_in_user($app) {
  if (logged_in($app)) {
    $app->flash('danger', ['You are already logged in.']);
    $app->redirect('/');
  }
}
/**
 * Returns true if the user is logged in.
 */
function logged_in($app) {
  if (current_user($app)) return true;
}

function current_user($app) {
  if ($user_id = $_SESSION['user_id'])
    return $current_user = User::find($user_id);
  // elseif ($user_id = $app->getCookie('user_id')) {
  //   $user = User::find($user_id);
  //   if $user && $user->authenticated('remember', $app->getCookie('remember_token')) {
  //     log_in($user);
  //     return $current_user = $user;
  //   }
  }

}

function log_in($user) {
  $_SESSION['user_id'] = $user->id;
}

$logged_in_user = function() {};

$correct_user = function() {};


// Refactoring:
// rename to authenticate
// access_denied + authentication = one method

$authentication = function($app, $user, $authentication_role) {
  return function() use ($app, $user, $authentication_role) {
    $user_role = $user->getRole();
    if ($authentication_role != $user_role) {
      switch($user_role){
        case 'admin': $app->redirect("/adminbar"); break;
        case 'user': $app->redirect("/account"); break;
        case 'guest': 
          $app->flash('error', 'Login required');
          $app->setCookie('urlRedirect', $app->request()->getPathInfo(), '4 minutes');
          $app->redirect("/login");
          break;
        }
    }
  };
};

$access_denied = function($app, $user, $denied_user_role) {
  return function() use ($app, $user, $denied_user_role) {
    $user_role = $user->getRole();
    if ($denied_user_role == $user_role) {
      switch($denied_user_role){
        case 'admin': $app->redirect("/adminbar"); break;
        case 'user': $app->redirect("/account"); break;
        case 'guest': 
          $app->flash('error', 'Login required');
          $app->setCookie('urlRedirect', $app->request()->getPathInfo(), '4 minutes');
          $app->redirect("/login");
          break;
        }
    }
  };
};