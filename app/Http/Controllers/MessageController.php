<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Data\ServiceJournal\Dal\ServiceJournalMessageDal;

class MessageController extends Controller
{
    public function index()
    {
        return view('messages.index');
    }

    public function managerMessageList($servicesJournalId)
    {
        $messages = \App\Data\ServiceJournal\Model\ServiceJournalMessage::with(['message', 'createdBy'])
            ->where('service_journal_id', $servicesJournalId)
            ->orderBy('create_date', 'asc')
            ->get();
        return response()->json(['messages' => $messages]);
    }

    public function addManagerServiceMessage(Request $request)
    {
        $serviceJournalId = $request->input('serviceJournalId');
        $message = $request->input('message');
        
        try {
            ServiceJournalMessageDal::insertServiceJournalMessage($serviceJournalId, '', $message);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function messageTaskList(Request $request)
    {
        return response()->json(['tasks' => []]);
    }

    public function addTaskMessage(Request $request)
    {
        return response()->json(['success' => true]);
    }

    public function managerServiceMessageList()
    {
        return view('Manager.Messages.index');
    }

    public function clientServiceMessageList()
    {
        $serviceMessageList = collect(); // TODO: Add actual data logic
        return view('Client.serviceMessageList', compact('serviceMessageList'));
    }

    public function clientMessageList($serviceJournalId)
    {
        return response()->json(['messages' => []]);
    }

    public function addClientServiceMessage(Request $request)
    {
        return response()->json(['success' => true]);
    }
}