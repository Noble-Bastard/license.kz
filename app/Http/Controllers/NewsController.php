<?php

namespace App\Http\Controllers;

use App\Data\Core\Dal\NewsDal;
use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Model\Faq;
use App\Data\Core\Model\News;
use App\Data\Core\Model\NewsComments;
use App\Data\Core\Model\NewsTag;
use App\Data\Helper\Assistant;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Notify\Dal\AMOCrm;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Subsciption\Dal\EventSubscriptionDal;
use App\Data\Subsciption\Model\EventSubscription;
use App\Data\Translation\Dal\TranslationDal;
use App\Http\Controllers\Controller;
use App\Mail\NpaChangeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Data\Core\Dal\NewsCommentsDal;

class NewsController extends Controller
{
    private $entityName = 'news';
    private $validateRule = [
        'header' => 'required|string|max:1024',
        'content' => 'required|string',
        'country_id' => 'required|numeric'
    ];

    public function newsList(Request $request)
    {
        return $this->_newsList($this->prepareFilter($request), 1);
    }

    public function governmentAgenciesNewsList(Request $request)
    {
        return $this->_newsList($this->prepareFilter($request), 2);
    }

    public function npaNewsList(Request $request)
    {
        return $this->_newsList($this->prepareFilter($request), 3);
    }

    public function expertNewsList(Request $request)
    {
        return $this->_newsList($this->prepareFilter($request), 4);
    }

    public function faqList(Request $request)
    {
        $filter = new \stdClass();
        $filter->search = null;
        if($request->has('search')){
            $filter->search = $request->get('search');
        }

        $header = trans('messages.pages.news.faq.header');
        $description = trans('messages.pages.news.faq.description');

        $faqList = Faq::where('is_moderate', true);
        if($request->has('search')){
            $faqList = $faqList
                ->where('question', 'like', '%' . Input::get('search') . '%')
                ->orWhere('answer', 'like', '%' . Input::get('search') . '%');
        }
        $faqList = $faqList->orderByDesc('updated_at')->get();

        return view('news.faq')
            ->with('faqList', $faqList)
            ->with('filter', $filter)
            ->with('header', $header)
            ->with('description', $description);
    }

    private function prepareFilter(Request $request){
        $filter = new \stdClass();
        $filter->tags = array();
        $filter->startDate = '';
        $filter->endDate = '';
        $filter->sort = 'desc';
        $filter->search = null;

        if($request->has('tags')){
            $filter->tags = $request->get('tags');
        }
        if($request->has('startDate')){
            $filter->startDate = $request->get('startDate');
        }
        if($request->has('endDate')){
            $filter->endDate = $request->get('endDate');
        }
        if($request->has('sort')){
            $filter->sort = $request->get('sort');
        }
        if($request->has('search')){
            $filter->search = $request->get('search');
        }

        return $filter;
    }

    private function _newsList($filter, $contentType)
    {
        $header = null;
        $description = null;
        $contentTypeRoute = null;


        switch ($contentType){
            case 1:{
                $header = trans('messages.pages.news.news.header');
                $description = trans('messages.pages.news.news.description');
                $contentTypeRoute = route('news.list');
                break;
            }
            case 2:{
                $header = trans('messages.pages.news.state_organs.header');
                $description = trans('messages.pages.news.state_organs.description');
                $contentTypeRoute = route('news.government_agencies.list');
                break;
            }
            case 3:{
                $header = trans('messages.pages.news.npa.header');
                $description = trans('messages.pages.news.npa.description');
                $contentTypeRoute = route('news.npa.list');
                break;
            }
            case 4:{
                $header = trans('messages.pages.news.expert.header');
                $description = trans('messages.pages.news.expert.description');
                $contentTypeRoute = route('news.expert.list');
                break;
            }
        }

        $newsList = NewsDal::getList($contentType, true, $filter);
        $tagsList = NewsTag::where('news_content_type_id', $contentType)
            ->where('language_id', Assistant::getCurrentLanguageId())
            ->orderBy('name')
            ->get();

        return view('news.index')
            ->with('newsList', $newsList)
            ->with('tagsList', $tagsList)
            ->with('filter', $filter)
            ->with('header', $header)
            ->with('description', $description)
            ->with('route', $contentTypeRoute);
    }

    public function index()
    {
        $newsList = NewsDal::getList(1, true);

        return view('admin.news.index')
            ->with('newsList', $newsList);
    }

    public function get(Request $request, $id){
        $news = NewsDal::get($id, $request->ip());
        if(!$news){
            return abort(404);
        }

        NewsDal::setActivity($id, 1, $request->ip());

        $news = NewsDal::get($id, $request->ip());

        return view('news.fullNews')
            ->with('news', $news);
    }

    public function likeNews(Request $request, $id)
    {
        NewsDal::setActivity($id, 2, $request->ip());
        return response('');
    }

    public function unlikeNews(Request $request, $id)
    {
        NewsDal::removeActivity($id, 2, $request->ip());
        return response('');
    }

    public function create(){
        $countryList = CountryDal::getList(false, false);
        return view('admin.news.create')
            ->with('countryList', $countryList->pluck('name', 'id'));
    }

    public function store(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $this->set(false);

        return redirect(route('admin.news.list'));
    }

    public function edit($id){
        $news = NewsDal::get($id, false);

        $countryList = CountryDal::getList(false, false);

        return view('admin.news.edit')
            ->with('news', $news)
            ->with('countryList', $countryList->pluck('name', 'id'));
    }

    public function update(Request $request){
        Validator::make($request->all(), $this->validateRule)->validate();

        $this->set(true);

        return redirect(route('admin.news.list'));
    }

    private function set(bool $id = false){
        $entity = new News();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->country_id = Input::get('country_id');
        $entity->header = Input::get('header');
        $entity->content = Input::get('content');
        $entity->orderNum = Input::get('orderNum');
        $entity->is_actual =  (Input::get('news_is_actual') == null) ? 0 : 1;

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = NewsDal::set($entity);

        return $entity;
    }

    public function changePreviewPhoto(Request $request)
    {
        $newsId = $request->get('newsId');
        $previewPhoto = $request->file('previewPhoto');

        NewsDal::setPreviewPhoto($newsId, $previewPhoto);

        return 1;
    }

    public function destroy($id)
    {
        NewsDal::delete($id);
        return redirect(route('admin.news.list'));
    }

    public function setNewsActual(){
        NewsDal::setNewsActual(Input::get('news_id'), Input::get('isActial'));
        return redirect(route('admin.news.list'));
    }

    private function setComment(bool $id = false){
        $entity = new NewsComments();

        $entity->news_id = Input::get('news_id');
        $entity->level = 1;
        $entity->parent_comment_id = Input::get('comment_id') == '' ? null : Input::get('comment_id');
        $entity->comment = Input::get('comment_text');
        $entity->user_id = ProfileDal::getByUserId(Auth::id())->id;
        $entity->create_date = now();

        $entity = NewsCommentsDal::set($entity);

        return $entity;
    }

    public function newsCommentStore(Request $request){
        Validator::make($request->all(), [
            'comment_text' => 'required|string'
        ])->validate();

        $this->setComment(false);

        return redirect()->back();
    }


    public function commentList($newsId)
    {
        $news = NewsDal::get($newsId, true);
        return view('admin.news.commentList')
            ->with('news', $news);
    }

    public function deleteComment(Request $request)
    {
        $commentId = $request->get('commentId');

        $news = NewsCommentsDal::get($commentId)->news;

        NewsCommentsDal::delete($commentId);

        return view('admin.news._newsCommentList')
            ->with('commentList', $news->comments)
            ->with('currentId', null)
            ->with('currentLevel', 0);
    }

    public function subscribe(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');

        (new EventSubscriptionDal())->subscipt($name, $email);

        return response()->json(['success' => 'success'], 200);
    }

    public function unsubscribe(string $uuid)
    {
        (new EventSubscriptionDal())->unsubscipt($uuid);

        return redirect('/');
    }

    public function newsListByTag($tag)
    {
        $contentType = 1;

        $newsList = NewsDal::getList($contentType, true, $tag);

        $tagsList = NewsTag::where('news_content_type_id', $contentType)
            ->where('language_id', Assistant::getCurrentLanguageId())
            ->orderBy('name')
            ->get();

        return view('news.index')
            ->with('newsList', $newsList)
            ->with('tagsList', $tagsList);
    }

    public function faqNew(Request $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $question = $request->get('question');

        $faq = new Faq();
        $faq->name = $name;
        $faq->email = $email;
        $faq->phone = $phone;
        $faq->question = $question;
        $faq->save();

        $comment = "Новый вопрос-ответ: {$question}";
      $roistatVisitId = array_key_exists('roistat_visit', $_COOKIE) ? $_COOKIE['roistat_visit'] : "неизвестно";
        (new AMOCrm())->callMe('license-kz-callback', $name, $phone, $email, $comment, 'Новый вопрос-ответ', null, $roistatVisitId);

        return response()->json(['success' => 'success'], 200);
    }
}
