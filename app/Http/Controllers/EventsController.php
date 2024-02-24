<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-01-28
 * Time: 11:05 PM
 */
namespace App\Http\Controllers;

use App\Data\Career\Dal\CareerDal;
use App\Data\Career\Dal\CareerEducationDal;
use App\Data\Career\Dal\CareerExperienceDal;
use App\Data\Career\Dal\CareerLangKnowledgeDal;
use App\Data\Career\Model\Career;
use App\Data\Career\Model\CareerEditorSpeed;
use App\Data\Career\Dal\CareerEditorSpeedDal;
use App\Data\Career\Model\CareerEducation;
use App\Data\Career\Model\CareerExperience;
use App\Data\Career\Model\CareerLangKnowledge;
use App\Data\Career\Model\CareerSocial;
use App\Data\Core\Dal\SocialTypeDal;
use App\Data\Event\Dal\EventDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\EditorTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\SocialTypeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventsController extends Controller
{
    public function index()
    {
        $ourEventsList = EventDal::getSideList(1);
        $eventsList = EventDal::getSideList(2);
        return view('events.index')
            ->with('eventsList', $eventsList)->with('ourEventsList', $ourEventsList);
    }
}