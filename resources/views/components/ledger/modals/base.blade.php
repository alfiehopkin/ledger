<div x-data="{ show: @entangle($attributes->wire('model')).defer }"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-show="show"
    class="mt-6 border border-black overflow-hidden bg-yellow-100"
    x-cloak
>
    <div class="p-4 border-b border-black">
        {{ $title }}
    </div>

    <div class="p-4 pb-0">
        {{ $content }}
    </div>

    <div class="p-4 flex justify-end">
        {{ $footer }}
    </div>
</div>