<?
class Brand extends Illuminate\Database\Eloquent\Model {

  /**
   * The database table used by the model.
   *ven
   * @var string
   */
  protected $table = "brands";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
                         'name'
  ];

  /**
   * The attributes excluded from the model's JSON form.
   *
   * @var array
   */
  protected $hidden = [
                       'created_at',
                       'updated_at'
  ];

  public static $name_rules = ['name'      => 'required|between:2,120|unique:brands'];

}