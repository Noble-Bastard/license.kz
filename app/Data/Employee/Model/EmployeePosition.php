<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2018-12-20
 * Time: 9:47 PM
 */

namespace App\Data\Employee\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeePosition
 *
 * @package App\Data\Employee\Model
 * @property int id
 * @property string value
 * @mixin \Eloquent
 */
class EmployeePosition extends Model
{
    protected $table = 'employee_position';

    public $timestamps = false;

    protected $fillable = [
        'value'
    ];

    protected $guarded = ['id'];
}