@php
    $abbr_weeks = ['Su', 'M', 'T', 'W', 'Th', 'F', 'S'];
@endphp
<div class="grow flex flex-col xl:p-8 bg-slate-300 text-center
    text-sm sm:text-lg xl:text-3xl min-w-full text-slate-800
    font-['Montserrat']">
    <div class="sm:text-4xl py-8 cursor-default font-black text-2xl
        xl:text-5xl xl:py-8">
        {{ "$month_name $year" }}
    </div>
    <div class="flex items-center justify-around">
        <div wire:click="prev_month" class="flex justify-center items-center
            transition ease-out duration-50 rounded-full p-1 size-8 xl:size-14
            cursor-pointer hover:bg-slate-800 hover:text-slate-100
            sm:size-10 sm:p-2 hover:stroke-slate-100 stroke-slate-800">
            <svg viewBox="0 0 15 15" fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="">
                <path d="M6.85355 3.14645C7.04882 3.34171 7.04882 3.65829 6.85355 3.85355L3.70711 7H12.5C12.7761 7 13 7.22386 13 7.5C13 7.77614 12.7761 8 12.5 8H3.70711L6.85355 11.1464C7.04882 11.3417 7.04882 11.6583 6.85355 11.8536C6.65829 12.0488 6.34171 12.0488 6.14645 11.8536L2.14645 7.85355C1.95118 7.65829 1.95118 7.34171 2.14645 7.14645L6.14645 3.14645C6.34171 2.95118 6.65829 2.95118 6.85355 3.14645Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="table sm:py-8">
            <div class="table-header-group cursor-default">
                <div class="table-row">
                    @foreach($abbr_weeks as $week)
                    <div class="table-cell align-middle font-black xl:p-4">
                        {{ $week }}
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="table-row-group"
                wire:init="fetch_events(
                '{{ $selected_date->format('Y-m-d') }}')">
                @foreach($days as $week)
                <div class="table-row text-center">
                    @foreach($week as $day)
                    <div class="table-cell py-3 sm:p-3 xl:p-4">
                        <div
                            wire:click="fetch_events(
                            '{{ $day->format('Y-m-d') }}')"
                            class="m-auto flex justify-center items-center
                            transition ease-out duration-50 size-8 xl:size-16
                            cursor-pointer hover:text-slate-100 sm:size-10
                            hover:bg-slate-800 rounded-full
                            {{ $day->format('m') == $base_date->format('m') ?
                            'text-slate-800' : 'text-slate-400'}}
                            {{ $day->format('Y-m-d') ==
                            $selected_date->format('Y-m-d') ?
                            'bg-slate-700 !text-slate-100' : '' }}">
                            {{ $day->format('d') }}
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
            @if(count($days) < 6)
                @foreach(range(1, 6 - count($days)) as $idx)
                <div class="table-row-group p-1 size-14 sm:size-16
                    xl:size-24 xl:p-4">
                    <div class="table-cell">
                    </div>
                </div>
                @endforeach
            @endif
        </div>
        <div wire:click="next_month" class="flex justify-center items-center
            size-8 transition ease-out duration-50 rounded-full cursor-pointer
            xl:size-14 hover:bg-slate-800 hover:text-slate-100 p-1
            sm:size-10 sm:p-2 hover:stroke-slate-100 stroke-slate-800">
            <svg viewBox="0 0 15 15" fill="none"
                xmlns="http://www.w3.org/2000/svg"
                class="">
                <path d="M8.14645 3.14645C8.34171 2.95118 8.65829 2.95118 8.85355 3.14645L12.8536 7.14645C13.0488 7.34171 13.0488 7.65829 12.8536 7.85355L8.85355 11.8536C8.65829 12.0488 8.34171 12.0488 8.14645 11.8536C7.95118 11.6583 7.95118 11.3417 8.14645 11.1464L11.2929 8H2.5C2.22386 8 2 7.77614 2 7.5C2 7.22386 2.22386 7 2.5 7H11.2929L8.14645 3.85355C7.95118 3.65829 7.95118 3.34171 8.14645 3.14645Z" fill="currentColor" fill-rule="evenodd" clip-rule="evenodd"></path>
            </svg>
        </div>
    </div>
</div>
