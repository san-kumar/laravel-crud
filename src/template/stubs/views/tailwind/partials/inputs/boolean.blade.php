<div class="flex">
    <div class="flex items-center mb-4 mr-3">
        <input class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" type="radio" name="_id_" id="_id__yes" value="1" {{ _val_ == '1' ? 'checked' : '' }} _required_>
        <label class="text-sm font-medium text-gray-900 ml-2 block">Yes</label>
    </div>
    <div class="flex items-center mb-4">
        <input class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300" type="radio" name="_id_" id="_id__no" value="0" {{ _val_ == '0' ? 'checked' : '' }} _required_>
        <label class="text-sm font-medium text-gray-900 ml-2 block" for="inlineRadio2">No</label>
    </div>
</div>
