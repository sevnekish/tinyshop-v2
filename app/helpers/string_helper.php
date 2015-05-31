<?

class StringHelper {
  /**
   * Url safe base64 encode function
   */
  public static function base64_url_encode($input) {
   return urlencode(base64_encode($input));
  }
  /**
   * Url safe base64 decode function
   */
  public static function base64_url_decode($input) {
   return base64_decode(urldecode($input));
  }
  /**
   * Generate a simple random url safe string.
   */
  public static function random_string_simple($length = 16) {
    $charset = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    return self::base64_url_decode(substr(str_shuffle(str_repeat($charset, $length)), 0, $length));
  }
}
