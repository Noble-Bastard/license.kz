<div class="col-12 mt-3 mb-3 description">
    {!! $catalogItem->description !!}
</div>

@include('catalog._switchCatalogType', ['catalogItemList' => \App\Data\Catalog\Dal\CatalogDal::geNodeListByParentId($catalogItem->id, false, true)])
