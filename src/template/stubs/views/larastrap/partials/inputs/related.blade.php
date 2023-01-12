<x-larastrap::select name="_id_" label="_label_" :options="array_combine(array_map(fn($s)=>$s['id'], $_relateds_->toArray()), array_map(fn($s)=>$s['_readable_'], $_relateds_->toArray()))" value="_val_" _required_/>
<a class="d-inline-block text-end small mb-3" href="{{_relatedroute_}}"><i class="fa fa-plus-circle"></i> Create new _label_</a>
