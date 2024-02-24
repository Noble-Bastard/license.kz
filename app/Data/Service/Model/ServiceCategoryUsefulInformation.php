<?php

namespace App\Data\Service\Model;

use App\Data\Catalog\Model\Catalog;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Data\Service\Model\ServiceCategory
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property string $btn_name
 * @property string $file_path
 * @property int $service_category_id
 * @property int $order_no

 * @mixin \Eloquent
 */
class ServiceCategoryUsefulInformation extends Model
{
    use SoftDeletes;

    protected $table = 'service_category_useful_information';
    public $timestamps = false;

    protected $fillable = [
        'service_category_id',
        'order_no',
        'name',
        'short_description',
        'description',
        'btn_name',
        'file_path'
    ];
    protected $guarded = ['id'];

}
