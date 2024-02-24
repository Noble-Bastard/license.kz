<?php
/**
 * Created by PhpStorm.
 * User: r.biewald
 * Date: 02.05.2018
 * Time: 20:24
 */
namespace App\Data\Notify\Dal;


use App\Data\Helper\Assistant;
use App\Data\Notify\Model\Messages;
use App\Data\Notify\Model\MessagesReadHist;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Support\Facades\Auth;


class MessagesDal{

    /**
     * Get Messages by Id
     *
     * @param $newsId
     * @return mixed
     */
    public static function get($newsId)
    {
        $news = Messages::where('id', $newsId)->firstOrFail();
        return $news;
    }

    /**
     * Insert (or update)  Messages
     *
     * @param Messages $district
     * @return Messages
     */
    public static function set (Messages $srcEntity)
    {
        if (empty($srcEntity->id)) {
            $entity = new Messages;
        } else {
            $entity = Messages::where('id', $srcEntity->id)->firstOrFail();
        }
        $entity->caption = $srcEntity->caption;
        $entity->message = $srcEntity->message;
        $entity->email_journal_id = $srcEntity->email_journal_id;
        $entity->create_date = Assistant::getCurrentDate();
        $entity->save();
        return $entity;
    }

    public static function setMessagesReadHist ($messageId)
    {
        $messagesReadHist = new MessagesReadHist();
        $messagesReadHist->message_id = $messageId;
        $messagesReadHist->read_by = Auth::user()->id;
        $messagesReadHist->read_date = Assistant::getCurrentDate();
        $messagesReadHist->save();
        return $messagesReadHist;
    }

    /**
     * Delete Messages
     *
     * @param $entityId
     * @return bool
     */
    public static function delete($entityId)
    {
        Messages::where('id', $entityId)->delete();
        return true;
    }
    
    public static function getUnreadMessageByClient($clientProfileId){
        return [];
    }

    public static function getMessageListGroupByServiceByClient(){
        $serviceJournal = ServiceJournalDal::getServiceJournalListByCurrentUser(null, false);

        return $serviceJournal;
    }

    public static function getMessageListGroupByServiceByClientPagination()
    {
        $serviceJournal = ServiceJournalDal::getServiceJournalListByCurrentUser(null, true);

        return $serviceJournal;
    }

    public static function getMessageListGroupByServiceByManager($managerId, $isPaginate){
        $serviceJournal = ServiceJournalDal::getServiceJournalListByManager($managerId, $isPaginate);

        return $serviceJournal;
    }
}