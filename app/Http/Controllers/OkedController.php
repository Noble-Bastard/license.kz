<?php
namespace App\Http\Controllers;

use App\Repositories\Interfaces\IOkedRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class OkedController extends Controller
{
    private $okedRepository;

    /**
     * OkedController constructor.
     * @param IOkedRepository $okedRepository
     */
    public function __construct(IOkedRepository $okedRepository)
    {
        $this->okedRepository = $okedRepository;
    }

    public function index(Request $request)
    {
        $filter = new \stdClass();
        $filter->search = null;
        if($request->has('search')){
            $filter->search = $request->get('search');
        }

        $header = trans('messages.pages.oked.header');
        $description = trans('messages.pages.oked.description');

        $okedList = null;
        if($request->has('search')){
            $okedList = $this->okedRepository->search(Input::get('search'));
        }

        return view('oked.index')
            ->with('okedList', $okedList)
            ->with('filter', $filter)
            ->with('header', $header)
            ->with('description', $description);

    }
}
