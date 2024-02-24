<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\TaskDocumentExt
 *
 * @property int $id
 * @property int $task_id
 * @property int $document_id
 * @property string|null $document_name
 * @property string|null $document_path
 * @property int|null $document_type_id
 * @property string|null $document_type_name
 * @property string $create_date
 * @property string $description
 * @property int $project_id
 * @property-read \App\Data\Document\Model\Document $document
 * @property-read \App\Data\Task\Model\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereDocumentName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereDocumentPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereDocumentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereDocumentTypeName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocumentExt whereTaskId($value)
 * @mixin \Eloquent
 */
class TaskDocumentExt extends Model
{
    protected $table = 'task_document_ext';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'document_id',
        'document_name',
        'document_path',
        'document_type_id',
        'document_type_name',
        'create_date',
        'description',
        'project_id'
    ];
    protected $guarded = ['id'];

    public function task()
    {
        return $this->hasOne('App\Data\Task\Model\Task','id','task_id');
    }

    public function document()
    {
        return $this->hasOne('App\Data\Document\Model\Document','id','document_id');
    }
}
