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
 * Class EmployeeSkill
 *
 * @package App\Data\Employee\Model
 * @property int id
 * @property string value
 * @property int employee_id
 * @mixin \Eloquent
 */
class EmployeeSkill extends Model
{
    protected $table = 'employee_skill';

    public $timestamps = false;

    protected $fillable = [
        'value',
        'employee_id'
    ];

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasOne('App\Data\Employee\Model\EmployeePosition','id','employee_id');
    }
}