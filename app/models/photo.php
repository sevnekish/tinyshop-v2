<?
class Photo extends Illuminate\Database\Eloquent\Model {

  /**
   * The database table used by the model.
   *ven
   * @var string
   */
  protected $table = "photos";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['item_id',
                         'photo'
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

}