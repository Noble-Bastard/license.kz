<?php

namespace App\Http\Controllers\Executor;

use App\Data\Document\Dal\DocumentDal;
use App\Data\Document\Model\Document;
use App\Data\Helper\DocumentTypeList;
use App\Data\Notify\Dal\MessagesDal;
use App\Data\Task\Dal\TaskMessageDal;
use App\Data\Task\Dal\TaskDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class TaskController extends Controller
{
    //
    public static function taskShow($taskId)
    {
        $task = TaskDal::get($taskId);
        $docList=TaskDal::getTaskDocumentListBy($taskId);
        return view('Executor.task.show')
            ->with('task', $task)
            ->with('docList', $docList);
    }

    public function addDocument(Request $request){
        $userId = Auth::id();

        $path = $request->file('doc')->store('docs/'. $userId);
        $taskId = $request->get('taskId');

        $document=new Document();
        $document->path=$path;
        $document->document_type_id = DocumentTypeList::NotDefined;
        $document->name=$request->get('docName');

        TaskDal::addTaskDocument($taskId,$document,$request->get('docName'));

        return back();

    }

    public function deleteDocument($taskId,$docId){

        TaskDal::deleteTaskDocument($docId);
        DocumentDal::delete($docId);

//        $task = TaskDal::get($taskId);
//        $docList=TaskDal::getTaskDocumentListBy($taskId);

        return back();
    }

    public function changeRelevance(int $taskId)
    {
        $relevance = Input::get('task_relevance');

        TaskDal::changeRelevance($taskId, $relevance);
    }

    public function start(int $taskId)
    {
        TaskDal::startTask($taskId);

        return back();
    }

    public function close(Request $request){
        $taskId = $request->get('taskId');
        $executionTimeFact = Input::get('execution_time_fact');
        $result = $request->get('result');

        TaskDal::closeTask($taskId, $executionTimeFact, $result ?? "");

        return back();
    }

    public function messageList()
    {
        $taskId = Input::get('taskId');

        $taskMessagesList = TaskMessageDal::getListByTask($taskId);
        $task = TaskDal::get($taskId);

        $unreadMessageList = $taskMessagesList->where('is_read', 0)->all();

        foreach ($unreadMessageList as $unreadMessage){
            MessagesDal::setMessagesReadHist($unreadMessage->message_id);
        }

        return view('Executor.Task._messageListPanel')
            ->with('task', $task)
            ->with('messagesList', $taskMessagesList);
    }

    public function messageCreate()
    {
        $taskId = Input::get('taskId');
        $messageContent = Input::get('messageContent');

        TaskMessageDal::insertTaskMessage($taskId, '', $messageContent);

        $taskMessagesList = TaskMessageDal::getListByTask($taskId);

        return view('_Message._messageList')
            ->with('messagesList', $taskMessagesList);
    }
}
