<?php

namespace App\Data\Core\Dal;

use App\Data\Core\Model\News;
use App\Data\Core\Model\NewsActivity;
use App\Data\Helper\Assistant;
use App\Data\Helper\EmailNotifyTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Notify\Model\EmailJournal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Subsciption\Dal\EventSubscriptionDal;
use App\Data\Translation\Dal\TranslationDal;
use App\Data\Translation\Model\Language;
use App\Mail\NpaChangeNotification;
use Illuminate\Support\Facades\App;

class NewsDal
{

  const entityName = 'news';

  /**
   * Get last actual News
   *
   * @param $newsCnt
   * @return mixed
   */
  public static function getTopActualNews($newsCnt)
  {
    $baseFields = [
      'news.id',
      'news.create_date',
      'news.is_actual',
      'news.orderNum',
      'news.country_id',
      'news.preview_photo',
    ];

    $entityList = News::where('is_actual', true)
      ->where('language_id', Assistant::getCurrentLanguageId())
      ->whereDate('create_date', '<=', date('Y-m-d H:i:s'))
      ->limit($newsCnt)
      ->orderBy('create_date', 'desc');
//        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, true);

    $newsList = $entityList->get();
    return $newsList;
  }

  public static function getActualNews(int $limit = null)
  {
    $baseFields = [
      'news.id',
      'news.create_date',
      'news.is_actual',
      'news.orderNum',
      'news.country_id',
      'news.preview_photo',
    ];

    $country = CountryDal::getByCode(Assistant::getCountryLocation());

    $entityList = News::where('is_actual', true)
      ->where('country_id', $country->id)
      ->orderBy('orderNum', 'asc');

    if ($limit != null) {
      $entityList = $entityList->limit($limit);
    }

    TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, true);

    $newsList = $entityList->get();
    return $newsList;
  }

  /**
   * Get last actual News
   *
   * @return mixed
   */
  public static function getTopOneActualNews()
  {
    $baseFields = [
      'news.id',
      'news.create_date',
      'news.is_actual',
      'news.orderNum',
      'news.country_id',
      'news.preview_photo',
    ];

    $entityList = News::where('news.is_actual', true)
      ->orderBy('news.create_date', 'desc');

    TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, true);

    $entityList = $entityList->first();

    return $entityList;
  }

  public static function getTopFiveActualNews()
  {
    return self::getTopActualNews(5);
  }

  /**
   * Get News list
   *
   * @param int $contentType
   * @param bool $withPagination
   * @param object|null $filter
   * @return mixed
   */
  public static function getList(int $contentType, bool $withPagination = false, object $filter = null)
  {
    $baseFields = [
      'news.id',
      'news.create_date',
      'news.is_actual',
      'news.orderNum',
      'news.country_id',
      'news.preview_photo',
      'country.name as country_name'
    ];

    $entityList = News::
    where('is_actual', true)
      ->whereDate('create_date', '<=', date('Y-m-d H:i:s'))
      ->where('language_id', Assistant::getCurrentLanguageId())
      ->where('news_content_type_id', $contentType);

    if (count($filter->tags)) {
      foreach ($filter->tags as $tag)
        $entityList = $entityList
          ->where('tags', 'like', '%' . $tag . '%');
    }

    if ($filter->startDate) {
      $entityList = $entityList->whereBetween('create_date', array($filter->startDate, $filter->endDate));
    }
    if ($filter->search) {
      $entityList = $entityList->where(function ($query) use ($filter) {
        $query
          ->where('header', 'like', '%' . $filter->search . '%')
          ->orWhere('lead', 'like', '%' . $filter->search . '%')
          ->orWhere('content', 'like', '%' . $filter->search . '%');
      });
    }

    $entityList = $entityList->orderBy('create_date', $filter->sort);

    //TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, false);

    if ($withPagination) {
      return $entityList->paginate(Assistant::getDefaultPaginateCnt());
    } else {
      return $entityList->get();
    }
  }


  /**
   * Get News by Id
   *
   * @param $newsId
   * @return mixed
   */
  public static function get($newsId, $ip)
  {
    $baseFields = [
      'news.id',
      'news.create_date',
      'news.is_actual',
      'news.orderNum',
      'news.country_id',
      'news.preview_photo',
    ];
    $entityList = News::from('news')
      ->where('news.id', $newsId)
      ->where('is_actual', true)
      ->whereDate('create_date', '<=', date('Y-m-d H:i:s'))
      ->withCount('newsView')
      ->withCount('newsLike')
      ->with(['newsLike' => function ($query) use ($ip) {
        $query->where(['ip' => $ip]);
      }]);
//        TranslationDal::generateQuery(self::entityName, $entityList, $baseFields, $translateData);

    return $entityList->first();
  }

  /**
   * Insert (or update)  News
   *
   * @param News $district
   * @return News
   */
  public static function set(News $srcEntity)
  {
    if (empty($srcEntity->id)) {
      $entity = new News;
    } else {
      $entity = News::where('id', $srcEntity->id)->firstOrFail();;
    }
    $entity->country_id = $srcEntity->country_id;
    $entity->header = $srcEntity->header;
    $entity->content = $srcEntity->content;
    $entity->is_actual = $srcEntity->is_actual;
    $entity->orderNum = $srcEntity->orderNum;
    $entity->save();

    TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

    return $entity;
  }

  /**
   * Delete News
   *
   * @param $entityId
   * @return bool
   */
  public static function delete($entityId)
  {
    TranslationDal::deleteByEntity(self::entityName, $entityId);

    $news = News::find($entityId);
    self::deleteNewsComments($news->comments);
    News::find($entityId)->delete();
    return true;
  }

  public static function deleteNewsComments($commentList)
  {
    foreach ($commentList as $comment) {
      if (sizeof($comment->answerList) > 0) {
        self::deleteNewsComments($comment->answerList);
      } else {
        $comment->delete();
      }
    }
  }

  /**
   * Set news status
   *
   * @param $entityId
   * @param $isActual
   * @return mixed
   */
  public static function setNewsActual($entityId, $isActual)
  {
    $srcEntity = News::where('id', $entityId)->firstOrFail();;
    $entity = $srcEntity;
    $entity->is_actual = $isActual;
    $entity->save();
    return $entity;
  }

  public static function getTopNewsList()
  {
    $message = News::orderBy('orderNum', 'asc')->get();
    return $message;
  }

  public static function setPreviewPhoto($newsId, $previewPhoto)
  {
    $news = News::where('id', $newsId)->first();

    if ($news != null) {
      $path = $previewPhoto->store(FilePathHelper::getNewsPreviewPhotoPath());

      $news->preview_photo = $path;
      $news->save();
    }

    return $news;
  }

  public static function setActivity($id, $activityType, $ip)
  {
    $newsActivity = NewsActivity::
    where('ip', $ip)
      ->where('news_id', $id)
      ->where('news_activity_type_id', $activityType)
      ->first();
    if (!isset($newsActivity)) {
      $newsActivity = new NewsActivity();
      $newsActivity->ip = $ip;
      $newsActivity->news_id = $id;
      $newsActivity->news_activity_type_id = $activityType;
      $newsActivity->save();
    }
  }

  public static function removeActivity($id, $activityType, $ip)
  {
    NewsActivity::
    where('ip', $ip)
      ->where('news_id', $id)
      ->where('news_activity_type_id', $activityType)
      ->delete();
  }

  public static function distributionNotify($newsId)
  {
    $subscriptionList = (new EventSubscriptionDal())->getSubscriptionList();

    foreach ($subscriptionList as $subscription) {
      $emailEntity = new EmailJournal();
      $emailEntity->recipients = $subscription->email;
      $emailEntity->subject = 'Изменения в НПА';
      $emailEntity->email_notify_type_id = EmailNotifyTypeList::NewsMessage;

      $attachList = array();

      (new NpaChangeNotification($emailEntity, $attachList, route('news.get', ['id' => $newsId]), $subscription->id))->setData();
    }
  }
}
