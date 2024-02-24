<?php
/**
 * Created by PhpStorm.
 * User: D.Telyuk
 * Date: 1/24/2019
 * Time: 9:34 PM
 */

namespace App\Data\DocumentTemplate;


use App\Data\Core\Dal\ProfileDal;
use App\Data\DocumentTemplate\Helper\ReplacmentItemType;
use App\Data\Helper\RoleList;
use App\Data\ServiceJournal\Dal\ServiceJournalDal;
use Illuminate\Support\Facades\Auth;

abstract class  DocumentManager
{
    protected $serviceJournalId;
    protected $documentTemplate;
    private $documentTemplateGenerator;
    private $replacementMap;
    private $imageMap;

    function __construct($documentTemplate, $documentTemplateGenerator)
    {
        $this->replacementMap = array();
        $this->imageMap = array();
        $this->documentTemplate = $documentTemplate;
        $this->documentTemplateGenerator = $documentTemplateGenerator;
    }

    protected function addReplacementMapItem($key, $replacement, $type = ReplacmentItemType::String)
    {
        array_push($this->replacementMap, array("key" => $key, "replacement" => $replacement, "type" => $type));
    }
    protected function addImageMapItem($imageName, $imagePath)
    {
        array_push($this->imageMap, array("name" => $imageName, 'path' => $imagePath));
    }

    protected abstract function prepareReplacementMap(): void;
    protected abstract function prepareImageMap(): void;

    public function getDocument() : String
    {
        $this->prepareReplacementMap();
        $this->prepareImageMap();
        return $this->documentTemplateGenerator->generate($this->replacementMap, $this->imageMap);
    }

    protected function checkDocumentAccess(){
        $serviceJournal = ServiceJournalDal::getExt($this->serviceJournalId);
        $profile = ProfileDal::getByUserId(Auth::id());
        if($profile->id != $serviceJournal->client_id && Auth::user()->isUserInRole(RoleList::Client))
            throw new \Exception("User have no permissions to access this area!");
    }
}
