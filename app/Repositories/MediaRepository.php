<?php


namespace App\Repositories;


use App\Data\Core\Dal\NewsDal;
use App\Data\Core\Model\News;
use App\Data\Core\Model\NewsTag;
use App\Data\Service\Model\Country;
use App\Data\Translation\Model\Language;
use App\Repositories\Interfaces\IMediaRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class MediaRepository extends BaseRepository implements IMediaRepository
{
    public function __construct(News $model)
    {
        parent::__construct($model);
    }

    public function create(array $attributes): Model
    {
        $country = Country::query()->where('code',$attributes['country_code'])->first();
        $language = Language::query()->where('code',$attributes['language_code'])->first();

        $mediaAttributes = [
            'create_date' => Carbon::parse($attributes['start_date'], 'utc')
                ->setTimezone(config('app.timezone')),
            'is_actual' => true,
            'header' => $attributes['header'],
            'content' => $attributes['content'],
            'orderNum' => 0,
            'country_id' => $country->id,
            'preview_photo' => array_key_exists('main_image_path', $attributes) ?
                $attributes['main_image_path'] : null,
            'tags' => $attributes['tags'],
            'lead' => $attributes['lead'],
            'news_content_type_id' => $attributes['content_type_id'],
            'language_id' => $language->id,
        ];

        $result = array_key_exists('id', $attributes) && $attributes['id'] ?
            parent::update($attributes['id'], $mediaAttributes)
            : parent::create($mediaAttributes);

        $this->updateTags($result);

        if($attributes['content_type_id'] === 3){
            NewsDal::distributionNotify($result->id);
        }

        return $result;
    }

    public function update($id, array $attributes): Model
    {
        return parent::update($id, [
            'id' => $id,
            'is_actual' => $attributes['is_actual']
        ]);
    }

    public function uploadFile(array $attributes) : string
    {
        $file = null;
        $directory = null;

        if (array_key_exists("file", $attributes))
            $file = $attributes["file"];

        if (array_key_exists("directory", $attributes))
            $directory = $attributes["directory"];

        return $this->persistStorageFile($file, $directory);
    }

    protected function persistStorageFile($file, $directory): string
    {
        $fileName = $file->getClientOriginalName();

        if(Storage::disk('public')->exists($directory . $fileName))
            return $directory . $fileName;

        if(!Storage::disk('public')->exists($directory)) {
            Storage::disk('public')->makeDirectory($directory);
        }

        return Storage::disk('public')->putFileAs(
            $directory, $file, $fileName
        );

    }

    protected function updateTags($news){
        $tagList = explode('#', $news->tags);
        foreach ($tagList as $tag){
            if($tag) {
                $tagVal = ltrim(rtrim($tag));
                $newsTag = NewsTag::firstOrNew([
                    'name' => $tagVal,
                    'news_content_type_id' => $news->news_content_type_id,
                    'language_id' => $news->language_id
                ]);

                $newsTag->save();
            }
        }
    }
}
