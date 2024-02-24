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
use App\Data\Career\Dal\CareerSocialDal;
use App\Data\Career\Model\Career;
use App\Data\Career\Model\CareerEditorSpeed;
use App\Data\Career\Dal\CareerEditorSpeedDal;
use App\Data\Career\Model\CareerEducation;
use App\Data\Career\Model\CareerExperience;
use App\Data\Career\Model\CareerLangKnowledge;
use App\Data\Career\Model\CareerSocial;
use App\Data\Core\Dal\SocialTypeDal;
use App\Data\Helper\Assistant;
use App\Data\Helper\EditorTypeList;
use App\Data\Helper\FilePathHelper;
use App\Data\Helper\SocialTypeList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CareerController extends Controller
{
    private $validateRule = [
        'fio' => 'required|string|max:1024',
        'dob' => 'required|date',
        'desired_position' => 'required|string|max:256',
        'useful_skills' => 'required|string|max:2048',
        'books_read_cnt' => 'required|numeric',
        'sport_attitude' => 'required|string|max:1024',
        'self_describe' => 'required|string|max:1024',
        'contribute_development' => 'required|string|max:1024',
        'self_see' => 'required|string|max:1024',
        'salary' => 'required|numeric',
        'want_our_team' => 'required|string|max:1024',
        'city_location' => 'required|string|max:1024',
        'social_status' => 'required|string|max:256',
        'phone' => 'required|string|max:128',
        'email' => 'required|string|max:128',
        'education_place.*' => 'required|string|max:2048',
        'education_start.*' => 'required|date',
        'education_end.*' => 'required|date',
        'education_description.*' => 'required|string|max:2048',
        'experience_place.*' => 'required|string|max:2048',
        'experience_start.*' => 'required|date',
        'experience_end.*' => 'required|date',
        'experience_main_responsibilities.*' => 'required|string|max:2048',
        'experience_merits.*' => 'required|string|max:2048',
        'lang_knowledge_lang_name.*' => 'required|string|max:124',
        'lang_knowledge_lang_level.*' => 'required|string|max:124',
        'word_editor_speed' => 'required|numeric',
        'excel_editor_speed' => 'required|numeric',
        'facebook' => 'string|max:128',
        'instagram' => 'string|max:128',
        'linkedln' => 'string|max:128',
    ];

    public function index()
    {
        return view('career.index');
    }

    public function create()
    {
        return view('career.form');
    }

    public function store(Request $request)
    {
        //Validator::make($request->all(), $this->validateRule)->validate();

        //career_form
        $career = new Career();
        $career->fio = Input::get('fio');
        $career->dob = Assistant::convertStringToDate(Input::get('dob'), 'd.m.Y');
        $career->photo_path = '';
        $career->desired_position = Input::get('desired_position');
        $career->useful_skills = Input::get('useful_skills');
        $career->books_read_cnt = Input::get('books_read_cnt');
        $career->sport_attitude = Input::get('sport_attitude');
        $career->self_describe = Input::get('self_describe');
        $career->contribute_development = Input::get('contribute_development');
        $career->self_see = Input::get('self_see');
        $career->salary = Input::get('salary');
        $career->want_our_team = Input::get('want_our_team');
        $career->city_location = Input::get('city_location');
        $career->social_status = Input::get('social_status');
        $career->phone = Input::get('phone');
        $career->email = Input::get('email');
        $career = CareerDal::set($career);

        //career_form_editor_speed
        $careerEditorSpeed = new CareerEditorSpeed();
        $careerEditorSpeed->career_form_id = $career->id;
        $careerEditorSpeed->editor_type_id = EditorTypeList::Word;
        $careerEditorSpeed->value = Input::get('word_editor_speed');
        CareerEditorSpeedDal::set($careerEditorSpeed);

        $careerEditorSpeed = new CareerEditorSpeed();
        $careerEditorSpeed->career_form_id = $career->id;
        $careerEditorSpeed->editor_type_id = EditorTypeList::Excel;
        $careerEditorSpeed->value = Input::get('excel_editor_speed');
        CareerEditorSpeedDal::set($careerEditorSpeed);

        //career_form_education
        foreach (Input::get('education_place') as $key => $value) {
            $careerEducation = new CareerEducation();
            $careerEducation->career_form_id = $career->id;
            $careerEducation->place = Input::get('education_place.'.$key);
            $careerEducation->start = Input::get('experience_start.'.$key);
            $careerEducation->end = Input::get('experience_end.'.$key);
            $careerEducation->description = Input::get('education_description.'.$key);
            CareerEducationDal::set($careerEducation);
        }

        //career_form_experience
        foreach (Input::get('experience_place') as $key => $value) {
            $careerExperience = new CareerExperience();
            $careerExperience->career_form_id = $career->id;
            $careerExperience->place = Input::get('experience_place.'.$key);
            $careerExperience->start = Input::get('experience_start.'.$key);
            $careerExperience->end = Input::get('experience_end.'.$key);
            $careerExperience->main_responsibilities = Input::get('experience_main_responsibilities.'.$key);
            $careerExperience->merits = Input::get('experience_merits.'.$key);
            CareerExperienceDal::set($careerExperience);
        }

        //career_form_lang_knowledge
        foreach (Input::get('lang_knowledge_lang_name') as $key => $value) {
            $careerLangKnowledge =  new CareerLangKnowledge();
            $careerLangKnowledge->career_form_id = $career->id;
            $careerLangKnowledge->lang_name = Input::get('lang_knowledge_lang_name.'.$key);
            $careerLangKnowledge->lang_level = Input::get('lang_knowledge_lang_level.'.$key);
            CareerLangKnowledgeDal::set($careerLangKnowledge);
        }

        //career_form_social
        if(!is_null(Input::get('facebook'))) {
            $careerSocial = new CareerSocial();
            $careerSocial->career_form_id = $career->id;
            $careerSocial->social_type_id = SocialTypeList::FACEBOOK;
            $careerSocial->value = Input::get('facebook');
            CareerSocialDal::set($careerSocial);
        }

        if(!is_null(Input::get('instagram'))) {
            $careerSocial = new CareerSocial();
            $careerSocial->career_form_id = $career->id;
            $careerSocial->social_type_id = SocialTypeList::INSTAGRAM;
            $careerSocial->value = Input::get('instagram');
            CareerSocialDal::set($careerSocial);
        }

        if(!is_null(Input::get('linkedln'))) {
            $careerSocial = new CareerSocial();
            $careerSocial->career_form_id = $career->id;
            $careerSocial->social_type_id = SocialTypeList::LINKEDIN;
            $careerSocial->value = Input::get('linkedln');
            CareerSocialDal::set($careerSocial);
        }

        if(!is_null($request->file('photo'))){
            $path = $request->file('photo')->store(FilePathHelper::getCareerFormPath());

            CareerDal::setPhotoPath($career->id, $path);
        }

        Session::flash('success_save', trans('messages.career_form.success_save'));
        return redirect(route('career'));
    }
}