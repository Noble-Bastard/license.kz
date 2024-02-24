<div class="col-12 reviews_block">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-12">
        <p class="reviews_title-head">
          Отзывы тех, кто уже получил лицензию с UPPERLICENSE
        </p>
      </div>
      <div class="col-sm-8 d-none">
        <a href="{{route('new-reviews')}}" type="button" class="btn btn-success main__partners_button">Отзывы
          довольных клиентов</a>
      </div>
    </div>
    <div class="row">
      @foreach($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Video)->take(3) as $reviewChunk)
        <div class="col-12 main__reviews_layout_1">
          <a target="_blank" href="{{$reviewChunk->youtube_url}}">
            <img src="{{$reviewChunk->youtube_preview}}"
                 class="main__reviews_photo-mini">
            <div class="col-12 main__reviews_title-description-head_layout_1">
              <p class="main__reviews_title-description-head_1">
                {{$reviewChunk->company_name}}
              </p>
              <p class="main__reviews_title-description-body_1">
                {{$reviewChunk->company_description}}</p>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</div>
