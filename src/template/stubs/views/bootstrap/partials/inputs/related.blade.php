<div class="d-flex flex-row align-items-center justify-content-between">
    <select name="_id_" id="_id_" class="form-control form-select flex-grow-1" _required_>
        <option value="">Select _name_</option>
        @foreach($_relateds_ as $_related_)
            <option value="{{ $_related_->id }}" {{ _val_ == $_related_->id ? "selected" : "" }}>{{ $_related_->_readable_ }}</option>
        @endforeach
    </select>

    <a class="btn btn-light text-nowrap" href="{{_relatedroute_}}"><i class="fa fa-plus-circle"></i> New</a>
</div>
