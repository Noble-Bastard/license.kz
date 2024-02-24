<?php


namespace App\Data\Event\Dal;


use App\Data\Event\Model\Event;
use App\Data\Event\Model\EventType;
use App\Data\Helper\Assistant;
use App\Data\Translation\Dal\TranslationDal;

class EventDal
{
    const entityName = 'event';
    const entityTypeName = 'event_type';
    const baseFields = ['event.id',
            'event.event_date',
            'event.name',
            'event.content',
            'event.city',
            'event.place',
            'event.preview_photo',
            'event.logo_photo',
            'event.event_type_id',
            'event.name_en',
            'event.content_en',
        ];

    /**
     * Get last events
     *
     * @return mixed
     */
    public static function getTopEvents(int $type)
    {
        $entityList = Event::where('event_type_id', $type)
            ->orderBy('event_date', 'asc')
            ->limit(4);
        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, true);

        $eventsList = $entityList->get();
        return $eventsList;
    }

    /**
     * Get Event list
     *
     * @return mixed
     */
    public static function getList(bool $withPagination = false)
    {
        $entityList = Event::orderBy('event.event_date')->with('eventType');
        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, false);
        if ($withPagination) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Get Side Event list
     *
     * @return mixed
     */
    public static function getSideList(int $id, bool $withPagination = false)
    {
        $entityList = Event::where('event.event_type_id', $id)->orderBy('event.event_date')->with('eventType');
        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, true);
        if ($withPagination) {
            return $entityList->paginate(Assistant::getDefaultPaginateCnt());
        } else {
            return $entityList->get();
        }
    }

    /**
     * Get Event Type list
     *
     * @return mixed
     */
    public static function getEventTypeList()
    {
        $entityList = EventType::orderBy('event_type.id');
        //TranslationDal::generateQuery(self::entityTypeName,  $entityList, ['event_type.name'], false);
        return $entityList->get();
    }

    /**
     * Get Event by Id
     *
     * @param $eventId
     * @return mixed
     */
    public static function get($eventId, bool $translateData)
    {
        $entityList = Event::from(self::entityName)->where('event.id', $eventId);
        TranslationDal::generateQuery(self::entityName, $entityList, self::baseFields, $translateData);

        return $entityList->first();
    }

    /**
     * Insert (or update)  Event
     *
     * @param Event $srcEntity
     * @return Event
     */
    public static function set (Event $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new Event;
        } else {
            $entity = Event::where('id',$srcEntity->id)->firstOrFail();;
        }
        $entity->name = $srcEntity->name;
        $entity->content = $srcEntity->content;
        $entity->name_en = $srcEntity->name_en;
        $entity->content_en = $srcEntity->content_en;
        $entity->event_date = $srcEntity->event_date;
        $entity->event_type_id = $srcEntity->event_type_id;
        $entity->city = $srcEntity->city;
        $entity->place = $srcEntity->place;
        $entity->preview_photo = $srcEntity->preview_photo;
        $entity->logo_photo = $srcEntity->logo_photo;
        $entity->save();

        TranslationDal::setEntityTranslation(self::entityName, $entity->id, $srcEntity);

        return $entity;
    }

    /**
     * Delete Event
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        TranslationDal::deleteByEntity(self::entityName, $entityId);

        Event::where('id', $entityId)->delete();
        return true;
    }

    public static function setPreviewPhotoPath($entityId, $photoPath)
    {
        $entity = Event::where('id', $entityId)->first();
        $entity->preview_photo = $photoPath;
        $entity->save();
    }

    public static function setLogoPhotoPath($entityId, $photoPath)
    {
        $entity = Event::where('id', $entityId)->first();
        $entity->logo_photo = $photoPath;
        $entity->save();
    }
}