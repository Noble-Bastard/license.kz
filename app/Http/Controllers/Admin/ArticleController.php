<?php

namespace App\Http\Controllers\Admin;

use App\Data\Article\Dal\ArticleDal;
use App\Data\Article\Model\Article;
use App\Data\Service\Dal\CountryDal;
use App\Data\Translation\Dal\TranslationDal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private $entityName = 'article';
    private $validateRule = [
        'content' => 'required|string',
        'country_id' => 'required|numeric',
        'article_type' => 'required|numeric',
        'orderNum' => 'required|numeric'
    ];

    public function index()
    {
        $articleList = ArticleDal::getArticleList(true);

        return view('admin.article.index')
            ->with('articleList', $articleList);
    }

    public function create()
    {
        $articleTypeList = ArticleDal::getArticleTypeList();
        $countryList = CountryDal::getList(false, false);

        return view('admin.article.create')
            ->with('articleTypeList', $articleTypeList->pluck('name', 'id'))
            ->with('countryList', $countryList->pluck('name', 'id'));
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $this->set(false);

        // redirect
        return redirect(route('admin.article.list'));
    }

    public function edit($id)
    {
        $article = ArticleDal::getArticle($id, false);
        $articleTypeList = ArticleDal::getArticleTypeList();
        $countryList = CountryDal::getList(false, false);
        return view('admin.article.edit')
            ->with('article', $article)
            ->with('articleTypeList', $articleTypeList->pluck('name', 'id'))
            ->with('countryList', $countryList->pluck('name', 'id'));
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $this->set(true);

        // redirect
        return redirect(route('admin.article.list'));
    }

    private function set(bool $id = false){
        $entity = new Article();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->content = Input::get('content');
        $entity->article_type = Input::get('article_type');
        $entity->orderNum = Input::get('orderNum');
        $entity->country_id = Input::get('country_id');

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = ArticleDal::set($entity);

        return $entity;
    }


    public function destroy($id)
    {
        ArticleDal::deleteArticle($id);
        return redirect(route('admin.article.list'));
    }
}
