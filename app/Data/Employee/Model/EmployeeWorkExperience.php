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
 * Class EmployeeWorkExperience
 *
 * @package App\Data\Employee\Model
 * @property int id
 * @property int employee_id
 * @property string work_place
 * @property string description
 * @property \DateTime start_date
 * @mixin \Eloquent
 */
class EmployeeWorkExperience extends Model
{
    protected $table = 'employee_work_experience';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'work_place',
        'description',
        'start_date'
    ];

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasOne('App\Data\Employee\Model\EmployeePosition','id','employee_id');
    }
}