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

  public static $name_rules         = ['name'      => 'required|between:2,120'];
  public static $email_rules        = ['email'     => 'required|max:255|email|unique:users'];
  public static $email_alt_rules    = ['email'     => 'required|max:255|email'];
  public static $password_rules     = ['password'  => 'required|between:6,255'];
  public static $password_alt_rules = ['password'  => 'between:6,255'];
  public static $telephone_rules    = ['telephone' => 'required|min:6|numeric'];
  public static $address_rules      = ['address'   => 'required|between:7,160'];



  public function save(array $options = array()) {
    //before save
    $this->email = strtolower($this->email);
    parent::save($options);
  }

  public function is_authenticated($attribute, $token) {
    $attribute = $attribute . '_digest';
    $digest = $this->{$attribute};
    return $digest == $token;
  }

  public function password_verify($password) {
    return password_verify($password, StringHelper::base64_url_decode($this->password_digest));
  }

  public function activate() {
    $this->activated = true;
    $this->activated_at = date ("Y-m-d H:i:s", time());
    $this->save();
  }

  public function new_token() {
    return StringHelper::random_string_simple(8);
  }

  public function remember() {
    $this->remember_digest = $this->new_token();
    $this->save();
  }

  public function forget() {
    $this->remember_digest = null;
    $this->save();
  }

  public function create_digest($attribute, $token = '') {
    $token = $token ? $token : $this->new_token();
    $attribute = $attribute . '_digest';
    $this->{$attribute} = StringHelper::base64_url_encode(password_hash($token, PASSWORD_BCRYPT));
    if ($attribute == 'reset_digest')
      $this->reset_sent_at = date ("Y-m-d H:i:s", time());
    $this->save();
  }

  public function password_reset_expired() {
    if ($this->time_difference(time(), strtotime($this->reset_sent_at)) > 2)
      return true;
  }

  private function time_difference($time1, $time2) {
    return round(($time1 - $time2)/3600, 1);
  }

  public function send_activation_email() {
    $tags_mail    = [':/name', ':/link'];
    //modify link with constant !!! Not final version!
    $link = 'http://tinyshopv2/account_activations/' . $user->activation_digest . '/edit/' . StringHelper::base64_url_encode($user->email);
    $replace_mail = [$this->name, $link];
    //modify path for file with constant !!! Not final version!
    $mail_html = str_replace($tags_mail, $replace_mail, file_get_contents('../app/views/mailer/activation_mail.php'));
    send_mail($this->email, $this->name, 'Activation email', $mail_html);
  }

  public function send_reset_email() {
    
  }


}