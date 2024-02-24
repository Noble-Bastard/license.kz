<?php
namespace App\Data\ExternalPartner\Model;

use Illuminate\Database\Eloquent\Model;


class ExternalPartner extends Model
{
    protected $table = 'external_partner';
    public $timestamps = false;

    protected $fillable = [
        'name',
    ];
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ExternalPartnerCategory::class);
    }
}