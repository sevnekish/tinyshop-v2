<?
class User extends Illuminate\Database\Eloquent\Model {
  protected $table = "users";

  private $email = '';

  public static function get_id($user) {
    
  }

  public static $rules = [
    'email'    => 'unique:users|email',
    'title'    => 'required|between:4,16',
    'content'  => 'required|min:3'
  ];


}