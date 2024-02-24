<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\NewsComments;
use App\Data\Core\Model\NewsCommentsExt;
use App\Data\Helper\Assistant;
use App\Data\Service\Dal\CountryDal;
use App\Data\Translation\Dal\TranslationDal;

class NewsCommentsDal
{

    const entityName = 'news_comments';


    /**
     * Get NewsComments list
     *
     * @return mixed
     */
    public static function getList(bool $withPagination = false)
    {
        $entityList = NewsComments::from('news_comments');

        if ($withPagination) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Get NewsComments list
     *
     * @return mixed
     */
    public static function getListByNews($news_id, bool $withPagination = false)
    {
        $entityList = NewsCommentsExt::where('news_id', $news_id)
            ->where('level', 1);

        if ($withPagination) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }


    public static function getListByNewsSecondLevel($news_id, bool $withPagination = false)
    {
        $entityList = NewsCommentsExt::where('news_id', $news_id)
            ->where('level', '>', 1);

        if ($withPagination) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }


    /**
     * Get NewsComments by Id
     *
     * @param $news_commentsId
     * @return mixed
     */
    public static function get($news_commentsId)
    {
        return NewsComments::where('id', $news_commentsId)->first();
    }

    /**
     * Insert (or update)  NewsComments
     *
     * @param NewsComments $district
     * @return NewsComments
     */
    public static function set(NewsComments $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new NewsComments;
        } else {
            $entity = NewsComments::where('id', $srcEntity->id)->firstOrFail();;
        }
        $entity->news_id = $srcEntity->news_id;
        $entity->parent_comment_id = $srcEntity->parent_comment_id;
        $entity->comment = $srcEntity->comment;
        $entity->create_date = $srcEntity->create_date;
        $entity->level = $srcEntity->level;
        $entity->user_id = $srcEntity->user_id;
        $entity->save();

        return $entity;
    }

    /**
     * Delete NewsComments
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        $comment = NewsComments::where('id', $entityId)->first();
        foreach($comment->answerList as $commentAnswer){
            NewsCommentsDal::delete($commentAnswer->id);
        }
        $comment->delete();
        return true;
    }
}
