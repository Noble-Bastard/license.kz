<?php

namespace App\Data\RegistrationForm\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\RegistrationForm\Model\RegistrationForm
 *
 * @property int $id
 * @property int $service_journal_id
 * @property string $form_number
 * @property string $create_date
 * @property-read \App\Data\ServiceJournal\Model\ServiceJournal $serviceJournal
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationForm whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationForm whereFormNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationForm whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\RegistrationForm\Model\RegistrationForm whereServiceJournalId($value)
 * @mixin \Eloquent
 */
class RegistrationForm extends Model
{
    protected $table = 'registration_form';
    public $timestamps = false;

    protected $fillable = [
        'service_journal_id',
        'form_number',
        'create_date'

    ];
    protected $guarded = ['id'];

    public function serviceJournal()
    {
        return $this->hasOne('App\Data\ServiceJournal\Model\ServiceJournal','id','service_journal_id');
    }
}
