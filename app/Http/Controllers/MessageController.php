<?php

namespace App\Http\Controllers;

use App\Data\Core\Dal\NewsDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Notify\Dal\MessagesDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalMessageDal;
use App\Http\Controllers\Executor\TaskController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class MessageController extends Controller
{
    public function clientServiceMessageList(){
        $clientId = Auth::id();

        $newsList = NewsDal::getTopFiveActualNews();
        $serviceMessageList = MessagesDal::getMessageListGroupByServiceByClientPagination();

        $messageReadHist = ServiceJournalMessageDal::getClientReadHist();

        foreach ($serviceMessageList as $serviceMessage){
            $serviceMessageReadHist = $messageReadHist->where('service_journal_id', $serviceMessage->id);
            $serviceMessage->last_date = sizeof($serviceMessageReadHist) == 0 ? null : $serviceMessageReadHist->last()->message_create_date;
            $serviceMessage->is_read = sizeof($serviceMessageReadHist) == 0 ? true : $serviceMessageReadHist->where('message_client_read_by', null)->count() == 0;
        }

        return view('Client.serviceMessageList')
            ->with('newsList', $newsList)
            ->with('serviceMessageList', $serviceMessageList);
    }

    public function clientMessageList($serviceJournalId){
        $serviceJournalExt = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournalMessagesList = ServiceJournalMessageDal::getListByServiceJournal($serviceJournalId);

        $messageReadHist = ServiceJournalMessageDal::getClientReadHist()->where('service_journal_id', $serviceJournalId);
        foreach ($serviceJournalMessagesList as $serviceJournalMessages){
            $serviceJournalMessages->is_read = sizeof($messageReadHist) == 0 ? true : $messageReadHist->where('message_id', $serviceJournalMessages->message_id)->first()->message_client_read_by != null;
        }

        $unreadMessageList = $messageReadHist->where('message_client_read_by', null)->all();

        foreach ($unreadMessageList as $unreadMessage){
            ServiceJournalMessageDal::markAsRead($unreadMessage->message_id);
        }

        return view('Client._messageListPanel')
            ->with('serviceJournal', $serviceJournalExt)
            ->with('messagesList', $serviceJournalMessagesList);
    }

    public function addClientServiceMessage(){
        $serviceJournalId = Input::get('serviceJournalId');
        $messageContent = Input::get('messageContent');

        ServiceJournalMessageDal::insertServiceJournalMessage($serviceJournalId, '', $messageContent);

        $serviceJournalMessagesList = ServiceJournalMessageDal::getListByServiceJournal($serviceJournalId);

        $messageReadHist = ServiceJournalMessageDal::getClientReadHist()->where('service_journal_id', $serviceJournalId);
        foreach ($serviceJournalMessagesList as $serviceJournalMessages){
            $serviceJournalMessages->is_read = sizeof($messageReadHist) == 0 ? false : $messageReadHist->where('message_id', $serviceJournalMessages->message_id)->first()->message_client_read_by != null;
        }

        return view('_Message._messageList')
            ->with('messagesList', $serviceJournalMessagesList);
    }

    public function managerServiceMessageList(){
        $manager = ProfileDal::getByUserId(Auth::id());

        $newsList = NewsDal::getTopFiveActualNews();
        $serviceMessageList = MessagesDal::getMessageListGroupByServiceByManager($manager->id, true);

        $messageReadHist = ServiceJournalMessageDal::getManagerReadHist();

        foreach ($serviceMessageList as $serviceMessage){
            $serviceMessageReadHist = $messageReadHist->where('service_journal_id', $serviceMessage->id);
            $serviceMessage->last_date = sizeof($serviceMessageReadHist) == 0 ? null : $serviceMessageReadHist->last()->message_create_date;
            $serviceMessage->is_read = sizeof($serviceMessageReadHist) == 0 ? false : $serviceMessageReadHist->where('message_manager_read_by', null)->count() == 0;
        }

        return view('Manager.Messages.serviceMessageList')
            ->with('newsList', $newsList)
            ->with('serviceMessageList', $serviceMessageList);
    }

    public function managerMessageList($serviceJournalId){
        $serviceJournalExt = ServiceJournalDal::getExt($serviceJournalId);
        $serviceJournalMessagesList = ServiceJournalMessageDal::getListByServiceJournal($serviceJournalId);

        $messageReadHist = ServiceJournalMessageDal::getManagerReadHist()->where('service_journal_id', $serviceJournalId);
        foreach ($serviceJournalMessagesList as $serviceJournalMessages){
            $serviceJournalMessages->is_read = sizeof($messageReadHist) == 0 ? false : $messageReadHist->where('message_id', $serviceJournalMessages->message_id)->first()->message_manager_read_by != null;
        }

        $unreadMessageList = $messageReadHist->where('message_manager_read_by', null)->all();

        foreach ($unreadMessageList as $unreadMessage){
            ServiceJournalMessageDal::markAsRead($unreadMessage->message_id);
        }

        return view('Manager.Messages._messageListPanel')
            ->with('serviceJournal', $serviceJournalExt)
            ->with('messagesList', $serviceJournalMessagesList);
    }

    public function addManagerServiceMessage(){
        $serviceJournalId = Input::get('serviceJournalId');
        $messageContent = Input::get('messageContent');

        ServiceJournalMessageDal::insertServiceJournalMessage($serviceJournalId, '', $messageContent);

        $serviceJournalMessagesList = ServiceJournalMessageDal::getListByServiceJournal($serviceJournalId);

        $messageReadHist = ServiceJournalMessageDal::getClientReadHist()->where('service_journal_id', $serviceJournalId);
        foreach ($serviceJournalMessagesList as $serviceJournalMessages){
            $serviceJournalMessages->is_read = sizeof($messageReadHist) == 0 ? false : $messageReadHist->where('message_id', $serviceJournalMessages->message_id)->first()->message_manager_read_by != null;
        }

        return view('_Message._messageList')
            ->with('messagesList', $serviceJournalMessagesList);
    }

    public function messageTaskList()
    {
        $taskController = new TaskController();
        return $taskController->messageList();
    }

    public function addTaskMessage()
    {
        $taskController = new TaskController();
        return $taskController->messageCreate();
    }
}
