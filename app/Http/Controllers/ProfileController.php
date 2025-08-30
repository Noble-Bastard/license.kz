<?php

namespace App\Http\Controllers;

use App\Data\Core\Dal\ProfileDal;
use App\Data\Core\Dal\SettingDal;
use App\Data\Document\Dal\ProfileDocumentDal;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\ServiceStatusTypeList;
use App\Data\Notify\Dal\MessagesDal;
use App\Data\Service\Dal\CountryDal;
use App\Data\Service\Dal\ServiceStepRequiredDocumentDal;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use App\Data\ServiceJournal\Dal\ServiceJournalMessageDal;
use App\Data\ServiceJournal\Model\ServiceJournal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Data\Core\Dal\NewsDal;
use App\Data\Document\Model\Document;
use App\Data\Service\Model\Country;
use App\Data\Helper\Assistant;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
       /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = ProfileDal::getByUserId(Auth::id());
        $documentList = ProfileDocumentDal::getListByProfile($profile->id);

        $messageReadHist = ServiceJournalMessageDal::getClientReadHist();
        $messageCnt = $messageReadHist->where('message_client_read_by', null)->count();

        $serviceJournalList = ServiceJournalDal::getServiceJournalListByCurrentUser(null, true);

        return view('Client.profile')
            ->with('profile', $profile)
            //->with('documentList', $documentList)
            //->with('serviceJournalList', $serviceJournalList)
            ->with('messageCnt', $messageCnt)
        ;
    }

    public function serviceList()
    {
        $service_status_type = Input::has('service_status_type') ? Input::get('service_status_type') : ServiceStatusTypeList::Opened;
        $messageReadHist = ServiceJournalMessageDal::getClientReadHist();
        $messageCnt = $messageReadHist->where('message_client_read_by', null)->count();
        $serviceJournalList = ServiceJournalDal::getServiceJournalListByCurrentUserAndStatusType($service_status_type, false);

        return view('Client.serviceList')
            ->with('messageCnt', $messageCnt)
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatusType', $service_status_type)
        ;
    }


    public function serviceListByStatus($service_status_id)
    {
        return self::index($service_status_id);
    }

    public function addDocument(Request $request){
        $profile = ProfileDal::getByUserId(Auth::id());

        $path = $request->file('doc')->store(FilePathHelper::getClientDocsPath($profile->id));

        ProfileDocumentDal::insert($profile->id, $request->get('docName'), $path);
        return self::documentList();
    }

    public function addPhoto(Request $request)
    {
        $profile = ProfileDal::getByUserId(Auth::id());

        $path = $request->file('photo')->store(FilePathHelper::getProfilePhoto($profile->id));
        $document = new Document();
        $document->path = $path;
        $document->name = 'photo';
        ProfileDal::setProfilePhoto($profile->id, $document);
        return redirect(route('profile'));

    }

    public function deleteDocument($documentId){
        ProfileDocumentDal::delete($documentId);
        return $documentId;
    }

    public function uploadForm()
    {
        return view('Client.uploadFile');
    }

    public function bookkeeping()
    {
        $service_status_type = Input::has('service_status_type') ? Input::get('service_status_type') : ServiceStatusTypeList::Opened;
        $serviceJournalList = ServiceJournalDal::getServiceJournalListByCurrentUserAndStatusType($service_status_type, false);

        return view('Client.accounting')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatusType', $service_status_type)
            ;
    }

    public function documentList(){
        $service_status_type = Input::has('service_status_type') ? Input::get('service_status_type') : ServiceStatusTypeList::Opened;
        $serviceJournalList = ServiceJournalDal::getServiceJournalListByCurrentUserAndStatusType($service_status_type, false);

        return view('Client.documentList')
            ->with('serviceJournalList', $serviceJournalList)
            ->with('serviceStatusType', $service_status_type);
    }

}
