<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Subject
 * 
 * @property int $product_id
 * @property string $brand
 * @property int $price
 * @property int $stock
 *
 * @package App\Models
 */
class Panel extends Model
{
	protected $table = 'solar_panel';
	protected $primaryKey = 'product_id';
	public $timestamps = false;

	protected $fillable = [
		'brand',
		'price'
	];
}
