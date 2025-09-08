
  <div class="container documents__window_layout_info">
    <div class="documents__window">
      <div class="col-12">
        <div class="row">
          <div class="col-md-8 col-12 order-1 order-md-0">
            <div class="col-md-8 col-12 text-md-start text-center">
              <p class="documents__window_title-head">{{$rootNode->category->name}}</p>
            </div>
            <div class="col-md-11 col-12 text-start">
              <p class="documents__window_title-description">
                {{$rootNode->category->description}}
              </p>
            </div>
          </div>

          <div class="col-md-4 col-6 mb-3 order-0 order-md-1">
            <img src="{{\Illuminate\Support\Facades\Storage::url($rootNode->category->img)}}"
                 class="documents__window_photo-crane">
          </div>
        </div>
      </div>

    </div>
  </div>

<div class="container documents__window_layout_access">
  <div class="col-12 text-md-start text-center">
    <p class="documents__window_title-access">Выберите разрешительный  документ</p>
  </div>

  <div class="col-12 documents__window_cards">
    <div class="row service-container">
      @foreach(collect($currentNode->childNodeList->where('is_visible', 1)->all())->sortBy('name') as $catalogItem)
        <div class="col-12 col-md-6 col-lg-4">
          <div class="card-layout">
          <div class="card-container" data-category-pretty-url="{{$catalogItem->pretty_url}}">
              <div class="row justify-content-center">
                <div class="col-2 col-md-12">
                  <div class="documents__window_category_number">{{$loop->index+1}}
                  </div>
                </div>
                <div class="col-10 col-md-12 documents__window_category_layout">
                  {{$catalogItem->name}}
                </div>
                <div class="col-12 text-md-center text-start">
                  {{--                                    <p class="documents__window_title-card_description">{{$catalogItem->description}}</p>--}}
                </div>
              </div>
              <div class="loader-line d-none"></div>
          </div>
          </div>
        </div>
      @endforeach
      <div class="service-content">

      </div>
    </div>
  </div>
</div>

