<?

class PasswordResetsHelper {
  public static function valid_user($app, $user, $reset_digest) {
    if (!$user || !$user->is_authenticated('reset', $reset_digest)) {
      $app->flash('messages', ['danger' => ['Invalid password reset link']]);
      $app->redirect('/');
    }
  }

  public static function check_expiration($app, $user) {
    if ($user->password_reset_expired()) {
      $app->flash('messages', ['danger' => ['Password reset link has expired']]);
      $app->redirect('/');
    }
  }
}