<div class="flex flex-col md:flex-row items-center justify-between">
    <select name="_id_" id="_id_" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" _required_>
        <option value="">Select _name_</option>
        @foreach($_relateds_ as $_related_)
            <option value="{{ $_related_->id }}" {{ _val_ == $_related_->id ? "selected" : "" }}>{{ $_related_->_readable_ }}</option>
        @endforeach
    </select>

    <a class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded py-1 px-3 leading-normal no-underline bg-gray-100 text-gray-800 hover:bg-gray-200 whitespace-nowrap" href="{{_relatedroute_}}"><i class="fa fa-plus-circle"></i> New</a>
</div>
