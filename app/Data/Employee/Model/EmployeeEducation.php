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
 * Class EmployeeEducation
 *
 * @package App\Data\Employee\Model
 * @property int id
 * @property int employee_id
 * @property string education_place
 * @property \DateTime start_date
 * @property \DateTime end_date
 * @mixin \Eloquent
 */
class EmployeeEducation extends Model
{
    protected $table = 'employee_education';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'education_place',
        'start_date',
        'end_date'
    ];

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasOne('App\Data\Employee\Model\EmployeePosition','id','employee_id');
    }
}