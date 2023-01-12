@@for($i = 0, $_var_ = $_vars_[0]; $i < count($_vars_); $i++, $_var_ = $_vars_[$i])
    <div class="d-flex flex-row align-items-center my-3">
        <img src="https://picsum.photos/50/50?@{{ $i }}" class="rounded-circle mx-3 order-md-@{{ $i ? '1' : '0' }}" alt="photo" />

        <div class="popover bs-popover-auto position-relative flex-grow-1" style="max-width: 100%" data-popper-placement="@{{ $i % 2 ? 'left' : 'right' }}">
            <div class="popover-arrow" style="position: absolute; top: 40px;"></div>
            <h3 class="popover-header d-flex flex-row align-items-center justify-content-between">
                <b>_title_ #@{{ $_var_->id }}</b>
                <small>12 mins ago</small>
            </h3>
            <div class="popover-body">
                @{{ $_var_->_readable_ }}
            </div>
        </div>
    </div>

@@endfor
