<div class="col-3 pl-0 pr-0">
    <a href="whatsapp://send?text={{$source}}">
        <img class="share-img" src="{{asset('images/share_icons/whatsapp.png')}}">
    </a>
</div>
<div class="col-3 pl-0 pr-0">
    <a href="tg://msg?text={{$source}}">
        <img class="share-img" src="{{asset('images/share_icons/telegram.png')}}">
    </a>
</div>
<div class="col-3 pl-0 pr-0">
    <a href="https://vk.com/share.php?url={{$source}}" target="_blank">
        <img
                class="share-img"
                src="{{asset('images/share_icons/vk.png')}}"></a>
</div>
<div class="col-3 pl-0 pr-0">
    <a href="https://www.facebook.com/sharer/sharer.php?u={{$source}}&amp;src=sdkpreparse"
            target="_blank">
        <img class="share-img" src="{{asset('images/share_icons/facebook.png')}}">
    </a>
</div>