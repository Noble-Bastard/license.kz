<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-04
 * Time: 9:50 PM
 */

namespace App\Http\Controllers\Head;


use App\Data\Career\Dal\CareerDal;
use App\Data\Career\Dal\CareerEditorSpeedDal;
use App\Data\Career\Dal\CareerEducationDal;
use App\Data\Career\Dal\CareerExperienceDal;
use App\Data\Career\Dal\CareerLangKnowledgeDal;
use App\Data\Career\Dal\CareerSocialDal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CareerController extends Controller
{
    public function index()
    {
        return view('Head.Career.index');
    }

    public function getList()
    {
        $entityList = CareerDal::getList(true);
        return response()->json($entityList);
    }

    public function show($careerFormId)
    {
        $entity = CareerDal::get($careerFormId);

        return view('Head.Career.show')
            ->with('entity', $entity);
    }

    public function delete()
    {
        $entityId = Input::get('entityId');

        CareerEditorSpeedDal::deleteByForm($entityId);
        CareerEducationDal::deleteByForm($entityId);
        CareerExperienceDal::deleteByForm($entityId);
        CareerLangKnowledgeDal::deleteByForm($entityId);
        CareerSocialDal::deleteByForm($entityId);

        CareerDal::delete($entityId);

        return response()->json('1');
    }
}