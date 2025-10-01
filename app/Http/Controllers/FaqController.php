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

        // Pagination parameters
        $perPage = 5; // Number of FAQs per page
        $currentPage = $request->get('page', 1);

        // Build query for moderated FAQs
        $query = Faq::query()
            ->where('is_moderate', 1)
            ->orderBy('created_at', 'desc');

        // Apply search filter if provided
        if (!empty($filter->search)) {
            $searchTerm = '%' . $filter->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('question', 'LIKE', $searchTerm)
                  ->orWhere('answer', 'LIKE', $searchTerm);
            });
        }

        // Get paginated results
        $faqList = $query->paginate($perPage, ['*'], 'page', $currentPage);

        // Check if this is an AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'faqList' => $faqList,
                'hasMorePages' => $faqList->hasMorePages(),
                'nextPage' => $faqList->hasMorePages() ? $faqList->currentPage() + 1 : null
            ]);
        }

        return view('faq-new')
            ->with('filter', $filter)
            ->with('faqList', $faqList);
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