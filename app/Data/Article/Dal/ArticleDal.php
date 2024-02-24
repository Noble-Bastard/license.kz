<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 29.07.2018
 * Time: 20:24
 */

namespace App\Data\Article\Dal;

use App\Data\Article\Model\Article;
use App\Data\Article\Model\ArticleType;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Translation\Dal\TranslationDal;

class ArticleDal
{
    const entityName = 'article';

    public static function set(Article $srcEntity)
    {
        if (is_null($srcEntity->id)) {
            $entity = new Article();
        } else {
            $entity = ArticleDal::getArticle($srcEntity->id, false);
        }

        $entity->content = $srcEntity->content;
        $entity->article_type = $srcEntity->article_type;
        $entity->orderNum = $srcEntity->orderNum;
        $entity->country_id = $srcEntity->country_id;
        $entity->save();

        TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

        return $entity;
    }

    public static function deleteArticle($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        Article::where('id', $entityId)->delete();
        return true;
    }

    public static function getArticleList(bool $withPagination)
    {
        $baseFields = [
            'article.id',
            'article.content',
            'article.orderNum',
            'article.article_type',
            'article.country_id',
            'country.name as country_name',
            'article_type.name as article_type_name'
        ];

        $entityList = Article::
            leftJoin('article_type', 'article_type.id', '=', 'article.article_type')
            ->leftJoin('country', 'country.id', '=', 'article.country_id')
            ->orderBy('article.article_type', 'asc');

        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, false);

        if($withPagination){
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    public static function getArticle($articleId, bool $translateData)
    {
        $baseFields = [
            'article.id',
            'article.content',
            'article.orderNum',
            'article.article_type',
            'article.country_id',
            'country.name as country_name'
        ];

        $entityList = Article::where('article.id', $articleId)
            ->leftJoin('country', 'country.id', '=', 'article.country_id')
            ->with('type')
        ;
        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

        return $entityList->first();
    }

    public static function getArticleTypeList()
    {
        return ArticleType::orderBy('name', 'asc')->get();
    }

    public static function getArticleByType($type, bool $translateData = false)
    {
        $baseFields = [
            'article.id',
            'article.content',
            'article.orderNum',
            'article.article_type',
            'article.country_id'
        ];

        $country = CountryDal::getByCode(Assistant::getCountryLocation());

        $entityList = Article::
            where('article.article_type', $type)
            ->where('country_id', $country->id)
            ->orderBy('article.orderNum', 'asc');

        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

        return $entityList->get();
    }
}