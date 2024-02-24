<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Career\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Company\Model\Career
 *
 * @property int $id
 * @property string fio
 * @property \DateTime dob
 * @property string photo_path
 * @property string desired_position
 * @property string useful_skills
 * @property int books_read_cnt
 * @property string sport_attitude
 * @property string self_describe
 * @property string contribute_development
 * @property string self_see
 * @property int salary
 * @property string want_our_team
 * @property string city_location
 * @property string social_status
 * @property string phone
 * @property string email
 *
 * @mixin \Eloquent
 */
class Career extends Model
{
    protected $table = 'career_form';
    public $timestamps = false;

    protected $fillable = [
        'fio',
        'dob',
        'photo_path',
        'desired_position',
        'useful_skills',
        'books_read_cnt',
        'sport_attitude',
        'self_describe',
        'contribute_development',
        'self_see',
        'salary',
        'want_our_team',
        'city_location',
        'social_status',
        'phone',
        'email'
    ];
    protected $guarded = ['id'];

    public function editorSpeeds()
    {
        return $this->hasMany('App\Data\Career\Model\CareerEditorSpeed', 'career_form_id', 'id');
    }

    public function educations()
    {
        return $this->hasMany('App\Data\Career\Model\CareerEducation', 'career_form_id', 'id');
    }

    public function experiences()
    {
        return $this->hasMany('App\Data\Career\Model\CareerExperience', 'career_form_id', 'id');
    }

    public function langKnowledge()
    {
        return $this->hasMany('App\Data\Career\Model\CareerLangKnowledge', 'career_form_id', 'id');
    }

    public function socials()
    {
        return $this->hasMany('App\Data\Career\Model\CareerSocial', 'career_form_id', 'id');
    }
}