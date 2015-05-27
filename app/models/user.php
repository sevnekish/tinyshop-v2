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

  public static $messages = [
    'required' => 'Your :attribute is required.',
    'min'      => 'Your :attribute must be at least :min characters long.',
    'max'      => 'Your :attribute must be a maximum of :max characters long.',
    'between'  => 'Your :attribute must be between :min - :max characters long.',
    'email'    => 'Your :attribute must be a valid email address',
    'unique'   => 'Your :attribute must be a unique'
  ];

}