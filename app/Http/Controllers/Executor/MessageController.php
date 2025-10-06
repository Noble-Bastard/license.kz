<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Data\ServiceJournal\Dal\ServiceJournalMessageDal;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        return view('Executor.messages.index');
    }

    public function managerMessageList($servicesJournalId)
    {
        return response()->json(['messages' => []]);
    }

    public function addManagerServiceMessage(Request $request)
    {
        return response()->json(['success' => true]);
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
        return view('Manager.messages.index');
    }

    public function clientServiceMessageList()
    {
        return view('Client.messages.index');
    }

    public function clientMessageList($serviceJournalId)
    {
        return response()->json(['messages' => []]);
    }

    public function addClientServiceMessage(Request $request)
    {
        return response()->json(['success' => true]);
    }

    public function addExecutorServiceMessage(Request $request)
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

    public function addExecutorStepMessage(Request $request)
    {
        $serviceJournalId = $request->input('serviceJournalId');
        $stepId = $request->input('stepId');
        $message = $request->input('message');
        
        try {
            // Пока отправляем как общее сообщение, так как нет колонки service_journal_step_id
            ServiceJournalMessageDal::insertServiceJournalMessage($serviceJournalId, '', $message);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}