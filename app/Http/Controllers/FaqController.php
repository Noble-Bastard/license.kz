<?php

namespace App\Http\Controllers;

use App\Data\Core\Dal\FaqDal;
use App\Data\Core\Dal\UserDal;
use App\Data\Core\Model\Faq;
use App\Data\Core\Model\UsersExt;
use App\Data\Helper\RoleList;
use App\Data\Service\Model\Service;
use App\Data\Translation\Dal\TranslationDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class FaqController extends Controller
{
    private $entityName = 'faq';

    private $validateRule = [
        'question' => 'required|string',
        'answer' => 'required|string'
    ];

    public function index()
    {
        return view('admin.news.faq');
    }

    public function faqList(){

        $userList = FaqDal::getList(true, true);

        return response()->json($userList);
    }

    public function indexRedesign(Request $request)
    {
        $filter = new \stdClass();
        $filter->search = $request->get('search', '');
        
        return view('faq-new')
            ->with('filter', $filter);
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $result = $this->set(false);

        return $result;
    }

    public function update(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $result = $this->set(true);

        return $result;
    }

    private function set(bool $id = false)
    {
        $entity = new Faq();

        if ($id) {
            $entity->id = Input::get('id');
        }

        $entity->question = Input::get('question');
        $entity->answer = Input::get('answer');
        $entity->is_moderate = Input::get('is_moderate');

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = FaqDal::set($entity);

        return response()->json($entity);
    }
}