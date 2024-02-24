<?php

namespace App\Data\Task\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Data\Task\Model\TaskDocument
 *
 * @property int $id
 * @property int $task_id
 * @property int $document_id
 * @property string $create_date
 * @property string $description
 * @property-read \App\Data\Document\Model\Document $document
 * @property-read \App\Data\Task\Model\Task $task
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocument whereCreateDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocument whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocument whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocument whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Data\Task\Model\TaskDocument whereTaskId($value)
 * @mixin \Eloquent
 */
class TaskDocument extends Model
{
    protected $table = 'task_document';
    public $timestamps = false;

    protected $fillable = [
        'task_id',
        'document_id',
        'create_date',
        'description'
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
