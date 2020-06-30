<aside class="widget widget_shop">
    <h4 class="widget-title">Categories</h4>
    @if($getAllCat)
        <ul class="ps-list--categories">
            @foreach($getAllCat as $key => $value)
                <li class="current-menu-item @if($value->getActiveSubcategory) menu-item-has-children @endif">
                    <a href="{{ asset('search-product?searchCategory='.$value->slug) }}">{{ $value->name }}</a>
                    @if($value->getActiveSubcategory->count()>0)
                    <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                        <ul class="sub-menu">
                            @foreach($value->getActiveSubcategory as $keySub => $valueSub)
                                <li class="current-menu-item menu-item-has-children "><a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug) }}">{{ $valueSub->name }}</a>
                                    @if($valueSub->getActiveChildCategory->count()>0)
                                    <span class="sub-toggle"><i class="fa fa-angle-down"></i></span>
                                        <ul class="sub-menu">
                                            @foreach($valueSub->getActiveChildCategory as $keyChild => $valueChild)
                                                <li class="current-menu-item "><a href="{{ asset('search-product?searchCategory='.$value->slug.'_'.$valueSub->slug.'_'.$valueChild->slug) }}">{{ $valueChild->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif  
</aside>
<aside class="widget widget_shop">
    <h4 class="widget-title">BY BRANDS</h4>
    <form class="ps-form--widget-search" action="{{ route('search-product') }}" method="get">
        <input name="serchbrand" class="form-control" type="text" placeholder="">
        <button><i class="icon-magnifier"></i></button>
    </form>
    <figure class="ps-custom-scrollbar" data-height="250">
        @foreach($brandlists as $allbrandName)
        <div class="ps-checkbox">
            <a href="{{ asset('search-product?serchbrand='.$allbrandName->name) }}">{{ $allbrandName->name }}</a>
        </div>
        @endforeach
    </figure>
</aside>