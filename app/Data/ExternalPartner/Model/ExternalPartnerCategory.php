<?php
namespace App\Data\ExternalPartner\Model;

use Illuminate\Database\Eloquent\Model;


class ExternalPartnerCategory extends Model
{
    protected $table = 'external_partner_category';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    protected $guarded = ['id'];

    public function partners()
    {
        return $this->hasMany(ExternalPartner::class);
    }
}