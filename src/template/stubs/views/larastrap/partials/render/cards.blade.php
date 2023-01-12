<div class="d-flex flex-row flex-wrap">

    @@foreach ($_vars_ as $_var_)
    <div class="card m-2" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">_title_ #@{{ $_var_->id }}</h5>
            <p class="card-text">@{{ $_var_->_readable_ }}</p>
        </div>
        <div class="card-footer">
            @if(!empty($hasSoftDelete))
                {!! $render('buttons/actions-trash') !!}
            @else
                {!! $render('buttons/actions') !!}
            @endif
        </div>
    </div>
    @@endforeach

</div>