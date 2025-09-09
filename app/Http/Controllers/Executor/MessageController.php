<?php

namespace App\Http\Controllers\Executor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}