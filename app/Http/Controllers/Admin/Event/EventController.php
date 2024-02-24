<?php


namespace App\Http\Controllers\Admin\Event;


use App\Data\Event\Dal\EventDal;
use App\Data\Event\Model\Event;
use App\Data\Helper\Assistant;
use App\Data\Helper\FilePathHelper;
use App\Data\Translation\Dal\TranslationDal;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    private $entityName = 'event';
    private $validateRule = [
        'event_type_id' => 'required|numeric',
        'name' => 'required|string|max:256',
        'content' => 'required|string',
        'event_date' => 'required|date'
    ];

    public function index()
    {
        return view('admin.event.list.index');
    }

    public function getList()
    {
        $entityList = EventDal::getList(true);
        return response()->json($entityList);
    }

    public function get($eventId)
    {
        $event = EventDal::get($eventId, true);
        $result = new \stdClass();
        $result->entity = $event;

        return response()->json($result);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(false);

        return response()->json($entity);
    }

    public function update(Request $request)
    {
        Validator::make($request->all(), $this->validateRule)->validate();

        $entity = $this->set(true);

        return response()->json($entity);
    }

    private function set(bool $id = false){
        $entity = new Event();

        if($id){
            $entity->id = Input::get('id');
        }

        $entity->event_date = Assistant::convertDateFormat(Input::get('event_date'), 'd.m.Y', 'Y-m-d');
        $entity->name = Input::get('name');
        $entity->content = Input::get('content');
        $entity->event_type_id = Input::get('event_type_id');
        $entity->city = Input::get('city') ?? '';
        $entity->place = Input::get('place') ?? '';
        $entity->preview_photo = null;
        $entity->logo_photo = null;

        TranslationDal::extendEntityAttribute($this->entityName, $entity);

        $entity = EventDal::set($entity);
        return $entity;
    }

    public function delete()
    {
        $eventId = Input::get('entityId');

        EventDal::delete($eventId);

        return response()->json('1');
    }


    public function changePreviewPhoto($id, Request $request)
    {
        $path = $request->file('preview')->store(FilePathHelper::getEventPhotoPath());

        EventDal::setPreviewPhotoPath($id, $path);
        return response()->json('1');
    }

    public function changeLogoPhoto($id, Request $request)
    {
        $path = $request->file('logo')->store(FilePathHelper::getEventPhotoPath());

        EventDal::setLogoPhotoPath($id, $path);
        return response()->json('1');
    }

    public function getEventTypeList()
    {
        $entityList = EventDal::getEventTypeList();
        return response()->json($entityList);
    }
}