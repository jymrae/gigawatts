<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $order_id
 * @property Carbon $time_placed
 * @property string $status
 * @property int $student_id
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';
	protected $primaryKey = 'order_id';
	public $timestamps = false;

	protected $casts = [
		'time_placed' => 'datetime',
		'student_id' => 'int'
	];

	protected $fillable = [
		'time_placed',
		'status',
		'student_id'
	];
}
