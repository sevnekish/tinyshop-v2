<?
/**
 * Custom helpers
 */



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