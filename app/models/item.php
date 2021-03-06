<?
class Item extends Illuminate\Database\Eloquent\Model {

  /**
   * The database table used by the model.
   *ven
   * @var string
   */
  protected $table = "items";

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = ['category_id',
                         'brand_id',
                         'model',
                         'characteristics',
                         'description',
                         'price',
                         'instock'
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