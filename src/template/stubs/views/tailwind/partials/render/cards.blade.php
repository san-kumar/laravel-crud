<div class="flex flex-row flex-wrap">

    @@foreach ($_vars_ as $_var_)
    <div class="relative flex flex-col min-w-0 rounded break-words border bg-white border-1 border-gray-300 m-2" style="width: 18rem;">
        <div class="flex-auto p-6">
            <h5 class="mb-3">_title_ #@{{ $_var_->id }}</h5>
            <p class="mb-0">@{{ $_var_->_readable_ }}</p>
        </div>
        <div class="py-3 px-6 bg-gray-200 border-t-1 border-gray-300">
            @if(!empty($hasSoftDelete))
                {!! $render('buttons/actions-trash') !!}
            @else
                {!! $render('buttons/actions') !!}
            @endif
        </div>
    </div>
    @@endforeach

</div>