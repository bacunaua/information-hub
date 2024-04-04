<div class="pb-1 shadow-2xl font-['Montserrat'] bg-slate-800 text-slate-200
    min-w-full min-h-full ">
    <div class="relative">
        <div class="sticky top-0 z-20 bg-slate-800 py-4 flex justify-center
            font-black sm:text-3xl text-2xl xl:text-3xl">
            <div id="events" class="text-center basis-3/4">
                <a href="#events">
                    Events
                </a>
            </div>
            <div wire:click="toggle_collapsible"
                class="xl:hidden cursor-pointer">
                {{ $is_expanded ? '-' : '+'}}
            </div>
        </div>
        <div class="xl:flex xl:flex-col {{ $is_expanded ? '' : 'hidden' }}">
        @foreach($events as $event)
            <div class="shadow-2xl text-md xl:text-md mx-4 mb-4 bg-slate-700
                @if(empty($events))
                @else
                    p-4
                @endif
            ">
                <div class="text-center text-xl xl:text-xl font-black pb-2">
                    {{ $event['name'] }}
                </div>
                <div class="flex">
                    <svg class="fill-slate-700 stroke-slate-100 size-6"
                        width="800px" height="800px"
                        viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 21C15.5 17.4 19 14.1764 19 10.2C19 6.22355 15.866 3 12 3C8.13401 3 5 6.22355 5 10.2C5 14.1764 8.5 17.4 12 21Z" stroke_width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M12 13C13.6569 13 15 11.6569 15 10C15 8.34315 13.6569 7 12 7C10.3431 7 9 8.34315 9 10C9 11.6569 10.3431 13 12 13Z" stroke_width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    <div class="px-2">
                        {{ $event['location'] }}
                    </div>
                </div>
                <div class="flex">
                    <svg class="fill-slate-700 stroke-slate-200 size-6"
                        width="800px" height="800px" viewBox="0 0 24 24"
                        fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M12 6V12"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                        <path d="M16.24 16.24L12 12"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>
                    <div class="px-2">
                        {{ "{$event['date']} {$event['time']}" }}
                    </div>
                </div>
                <div>
                    {{ "Hosted by {$event['host']}" }}
                </div>
                <div class="relative mx-2 mt-6 p-4 bg-slate-600">
                    <div class="bg-slate-800 p-2 shadow-2xl absolute -top-3
                    -left-2 xl:!text-md">
                        Additional Information
                    </div>
                    <svg class="fill-slate-700 stroke-slate-200 size-6"
                        <circle cx="12" cy="12" data-name="--Circle"
                            id="_--Circle" r="10" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="1.5"/>
                        <line stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" x1="12" x2="12" y1="12" y2="16"/>
                        <line stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="1.5" x1="12" x2="12" y1="8" y2="8"/>
                    </svg>
                    <div>
                        {{ $event['info'] }}
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>
