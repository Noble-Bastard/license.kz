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
 * Class EmployeeSocial
 *
 * @package App\Data\Employee\Model
 * @property int id
 * @property int employee_id
 * @property string value
 * @property int social_type_id

 * @mixin \Eloquent
 */
class EmployeeSocial extends Model
{
    protected $table = 'employee_social';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'value',
        'social_type_id'
    ];

    protected $guarded = ['id'];

    public function employee()
    {
        return $this->hasOne('App\Data\Employee\Model\EmployeePosition','id','employee_id');
    }
}