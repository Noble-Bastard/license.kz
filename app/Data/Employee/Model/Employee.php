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
 * Class Employee
 *
 * @package App\Data\Employee\Model
 * @property int employee_position_id
 * @property string first_name
 * @property string last_name
 * @property string photo_path
 * @property string description
 * @property string phone
 * @property string address
 * @property string email
 * @mixin \Eloquent
 */
class Employee extends Model
{
    protected $table = 'employee';

    public $timestamps = false;

    protected $fillable = [
        'employee_position_id',
        'first_name',
        'last_name',
        'photo_path',
        'description',
        'phone',
        'address',
        'email'
    ];

    protected $guarded = ['id'];

    public function position()
    {
        return $this->hasOne('App\Data\Employee\Model\EmployeePosition','id','employee_position_id');
    }

    public function skills()
    {
        return $this->hasMany('App\Data\Employee\Model\EmployeeSkill', 'employee_id', 'id');
    }

    public function educations()
    {
        return $this->hasMany('App\Data\Employee\Model\EmployeeEducation', 'employee_id', 'id');
    }

    public function workExperiences()
    {
        return $this->hasMany('App\Data\Employee\Model\EmployeeWorkExperience', 'employee_id', 'id');
    }

    public function socials()
    {
        return $this->hasMany('App\Data\Employee\Model\EmployeeSocials', 'employee_id', 'id');
    }

}