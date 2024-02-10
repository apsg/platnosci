<div wire:poll.5s>
    <div class="border border-red-600 rounded bg-white px-6 py-4 w-5/6 mx-auto">
        <div class="flex">
            <div>
                <div class="rounded text-white text-2xl font-bold text-center w-10 h-10"
                     style="line-height: 40px; background-color: {{ $color }}">
                    {{ $letter }}
                </div>
            </div>
            <div class="text-xs pl-6">
                {{ $text }}
                <br/>
            </div>
        </div>
        <div class="flex mt-2">
            <div class="w-10 text-gray-400 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="20" height="20" viewBox="0,0,256,256" class="mx-auto">
                    <g fill-opacity="0.16863" fill="#000000" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(8.53333,8.53333)"><path d="M15,3c-6.627,0 -12,5.373 -12,12c0,6.016 4.432,10.984 10.206,11.852v-8.672h-2.969v-3.154h2.969v-2.099c0,-3.475 1.693,-5 4.581,-5c1.383,0 2.115,0.103 2.461,0.149v2.753h-1.97c-1.226,0 -1.654,1.163 -1.654,2.473v1.724h3.593l-0.487,3.154h-3.106v8.697c5.857,-0.794 10.376,-5.802 10.376,-11.877c0,-6.627 -5.373,-12 -12,-12z"></path></g></g>
                </svg>
            </div>
            <div class="pl-6">
                <span class="font-bold text-sm">
                    {{ $name }}
                </span>
            </div>
        </div>
    </div>
</div>
