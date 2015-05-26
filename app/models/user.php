<?
class User extends Illuminate\Database\Eloquent\Model {
  protected $table = "users";

  public static function get_id($user) {
    
  }

  public static $rules = [
    'title'    => 'required|between:4,16',
    'content'  => 'required|min:3'
  ];

  public static $messages = [
    'required' => 'Your :attribute is required.',
    'min'      => 'Your :attribute must be at least :min characters long.',
    'max'      => 'Your :attribute must be a maximum of :max characters long.',
    'between'  => 'Your :attribute must be between :min - :max characters long.',
    'email'    => 'Your :attribute must be a valid email address'
  ];

  // private $errors;

  // private $rules = array(
  //   'title'   => 'required|between:4,16',
  //   'content'  => 'required|min:3'
  // );
  // private $messages = array(
  //   'required' => 'Your :attribute is required.',
  //   'min'      => 'Your :attribute must be at least :min characters long.',
  //   'max'      => 'Your :attribute must be a maximum of :max characters long.',
  //   'between'  => 'Your :attribute must be between :min - :max characters long.',
  //   'email'    => 'Your :attribute must be a valid email address'
  // );


  // public function validate($params)
  // {
  //     $validator = Validator::make( $params, $this->rules, $this->messages );
  //     if( $validator->fails() )
  //     {
  //       $this->errors = $validator->errors()->all();
  //       return false;
  //     }
  //     return true;
  // }    

  // public function errors()
  // {
  //   return $this->errors;
  // }
}