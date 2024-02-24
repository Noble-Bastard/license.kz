<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-01
 * Time: 4:42 PM
 */

namespace App\Data\Partner\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Company\Model\Partner
 *
 * @property int $id
 * @property string fio
 * @property string position
 * @property string email
 * @property string phone
 * @property string company_name
 * @property string company_site
 * @property string company_social
 * @property string company_location
 * @property string company_activity
 * @property string company_phone
 * @property string company_additionally
 * @property string company_logo
 *
 * @mixin \Eloquent
 */
class Partner extends Model
{
    protected $table = 'partner_form';
    public $timestamps = false;

    protected $fillable = [
        'fio',
        'position',
        'email',
        'phone',
        'company_name',
        'company_site',
        'company_location',
        'company_activity',
        'company_phone',
        'company_additionally',
        'company_logo'
    ];
    protected $guarded = ['id'];

    public function socials()
    {
        return $this->hasMany('App\Data\Partner\Model\PartnerSocial', 'partner_form_id', 'id');
    }
}