<?
class User extends Illuminate\Database\Eloquent\Model {

  // define('ACTMAIL', '');

  /**
   * The database table used by the model.
   *
   * @var string
   */
  protected $table = "users";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['name',
                         'email',
                         'telephone',
                         'address',
                         'password_digest'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = ['admin',
                       'password_digest',
                       'remember_token',
                       'actiovation_digest',
                       'activated',
                       'activated_at',
                       'reset_digest',
                       'reset_sent_at',
                       'created_at',
                       'updated_at'
  ];

  public static $name_rules      = ['name'      => 'required|between:2,120'];
  public static $email_rules     = ['email'     => 'required|max:255|email|unique:users'];
  public static $password_rules  = ['password'  => 'required|between:6,255'];
  public static $telephone_rules = ['telephone' => 'required|min:6|numeric'];
  public static $address_rules   = ['address'   => 'required|between:7,160'];



  public static $rules = [
    'email'    => 'required|email|max:255|unique:users',
    'title'    => 'required|between:4,16',
    'content'  => 'required|min:3'
  ];

  public function authenticated($attribute, $token) {
    // $diges = self::
  }

  public function new_token() {
    return StringHelper::random_string_simple(8);
  }

  public function create_password_digest($password) {
    return password_hash($password, PASSWORD_BCRYPT);
  }

  public function create_activation_digest() {
    // ? maybe need this only private with setting up only instance variable
    return StringHelper::base64_url_encode(password_hash($this->new_token(), PASSWORD_BCRYPT));
  }

  public function send_activation_email() {
    $tags_mail    = [':/name', ':/link'];
    $link = $_SERVER['SCRIPT_FILENAME'] . $this->create_activation_digest() . '/edit/' . $this->StringHelper::base64_url_encode($user->email);
    $replace_mail = [$this->name, $link];
    $mail_html = str_replace(,,file_get_contents('../views/mailer/activation_mail.php'));
    send_mail($this->email, $this->name, 'Activation email', $mail_html);
  }

  public function verify_password($password) {
    if (password_verify($password, $this->password_digest))
      return true;
    else
      return false;
  }


}