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
class Inverter extends Model
{
	protected $table = 'solar_inverter';
	protected $primaryKey = 'product_id';
	public $timestamps = false;

	protected $fillable = [
		'brand',
		'price'
	];
}
