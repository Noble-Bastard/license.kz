<?php
/**
 * Created by PhpStorm.
 * User: lechuk
 * Date: 2019-02-04
 * Time: 9:50 PM
 */

namespace App\Http\Controllers\Head;


use App\Data\Partner\Dal\PartnerDal;
use App\Data\Partner\Dal\PartnerEditorSpeedDal;
use App\Data\Partner\Dal\PartnerEducationDal;
use App\Data\Partner\Dal\PartnerExperienceDal;
use App\Data\Partner\Dal\PartnerLangKnowledgeDal;
use App\Data\Partner\Dal\PartnerSocialDal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class PartnerController extends Controller
{
    public function index()
    {
        return view('Head.Partner.index');
    }

    public function getList()
    {
        $entityList = PartnerDal::getList(true);
        return response()->json($entityList);
    }

    public function show($careerFormId)
    {
        $entity = PartnerDal::get($careerFormId);

        return view('Head.Partner.show')
            ->with('entity', $entity);
    }

    public function delete()
    {
        $entityId = Input::get('entityId');

        PartnerSocialDal::deleteByForm($entityId);
        PartnerDal::delete($entityId);

        return response()->json('1');
    }
}