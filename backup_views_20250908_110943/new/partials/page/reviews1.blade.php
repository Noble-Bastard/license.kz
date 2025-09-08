<div class="col-12 reviews_block mb-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-8 col-12">
        <p class="reviews_block_head-title">
          Отзывы тех, кто уже получил лицензию с UPPERLICENSE
        </p>
      </div>
      <div class="d-none d-sm-block col-sm-4">
        <div class="reviews_block_head-btn">
          <a href="{{route('new-reviews')}}" type="button" class="btn btn-outline-success main__partners_button">Отзывы
            довольных клиентов</a>
        </div>
      </div>
    </div>
    <div class="row">
      @foreach($reviewList->where('review_type_id', \App\Data\Helper\ReviewTypeList::Video)->take(3) as $reviewChunk)
        <div class="col-12 col-sm-4">
          <div class="reviews_block-card">
            <a target="_blank" href="{{$reviewChunk->youtube_url}}">
              <img src="{{$reviewChunk->youtube_preview}}"
                   class="main__reviews_photo-mini">
              <div class="col-12 reviews_block-card_description">
                <img src="{{asset('/new/images/play-circle-outline 1.svg')}}">
                {{$reviewChunk->company_description}}
              </div>
            </a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="row d-block d-sm-none">
      <div class="col-12">
        <div class="reviews_block_head-btn">
          <a href="{{route('new-reviews')}}" type="button" class="btn btn-outline-success main__partners_button">Отзывы
            довольных клиентов</a>
        </div>
      </div>
    </div>
  </div>
</div>
