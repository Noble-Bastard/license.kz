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
 * Class EmployeeSpeciality
 *
 * @package App\Data\Employee\Model
 * @property int id
 * @property int employee_id
 * @property string name
 * @property int value
 *
 * @mixin \Eloquent
 */
class EmployeeSpeciality extends Model
{
    protected $table = 'employee_speciality';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'name',
        'value'
    ];

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasOne('App\Data\Employee\Model\EmployeePosition','id','employee_id');
    }
}