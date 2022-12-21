<div id="messages" class="flex flex-col space-y-4 p-3 overflow-y-auto scrollbar-thumb-blue scrollbar-thumb-rounded scrollbar-track-blue-lighter scrollbar-w-2 scrolling-touch">
@@for($i = 0, $_var_ = $_vars_[0]; $i < count($_vars_); $i++, $_var_ = $_vars_[$i])
    @@if($i % 2)
    <div class="chat-message">
        <div class="flex items-end">
            <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-2 items-start">
                <div><span class="px-4 py-2 rounded-lg inline-block rounded-bl-none bg-gray-300 text-gray-600">@{{ $_var_->_readable_ }}</span></div>
            </div>
            <img src="https://picsum.photos/50/50?@{{ $i }}" alt="My profile" class="w-6 h-6 rounded-full order-1">
        </div>
    </div>
    @@else
    <div class="chat-message">
        <div class="flex items-end justify-end">
            <div class="flex flex-col space-y-2 text-xs max-w-xs mx-2 order-1 items-end">
                <div><span class="px-4 py-2 rounded-lg inline-block rounded-br-none bg-blue-600 text-white ">@{{ $_var_->_readable_ }}</span></div>
            </div>
            <img src="https://picsum.photos/50/50?@{{ $i }}" alt="My profile" class="w-6 h-6 rounded-full order-2">
        </div>
    </div>
    @@endif
@@endfor
</div>