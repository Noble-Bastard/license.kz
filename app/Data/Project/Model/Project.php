<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 14.05.2018
 * Time: 15:34
 */

namespace App\Data\Project\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Project
 *
 * @package App\Data\Project\Model
 * @property int $id
 * @property int service_journal_id
 * @property int manager_id
 * @property string description
 * @property \DateTime create_date
 * @property int created_by
 * @property int project_status_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Project\Model\Project whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Project\Model\Project whereCreatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Project\Model\Project whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Project\Model\Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Project\Model\Project whereManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Project\Model\Project whereServiceJournalId($value)
 * @mixin \Eloquent
 */

class Project extends Model
{
    protected $table = 'project';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'manager_id',
        'description',
        'create_date',
        'created_by',
        'project_status_id'
    ];

    protected $guarded = ['id'];
}