@php
    $headers = ['Name', 'Date']
@endphp
<div class="bg-slate-800 flex justify-center font['Montserrat']">
    <div class="flex flex-col justify-center text-center text-slate-100
        px-4 md:w-3/4">
        <div class="py-4 font-extrabold text-2xl flex justify-between
            ">
            @foreach($selected as $key => $val)
                <div class="flex flex-col">
                    {{ "$key -> $val" }}
                </div>
            @endforeach
            <div class="grow text-center">
                Manage Events
            </div>
            <button type=""
                class="text-slate-800 bg-green-500 rounded-md px-3 text-sm
                hover:bg-green-400 transition delay-50 ease-out"
            >
                Add Event
            </button>
        </div>
        <table class="cursor-default border-collapse">
            <thead class="font-bold">
                <tr class="border-y-2 border-slate-500">
                    <td class="align-middle">
                        <input
                            wire:model.live="select_all_checkbox"
                            wire:click="toggle_select_all"
                            type="checkbox">
                    </td>
                    @foreach($headers as $header)
                        <td class="p-2">{{ $header }}</td>
                    @endforeach
                    <td colspan="2">Actions</td>
                </tr>
            </thead>

            <tbody>
            @foreach($events as $event)
            <tr class="border-y border-slate-500">
                <td class="align-middle">
                    <input type="checkbox"
                        value="{{ $event['id'] }}"
                        wire:click="check_select_all"
                        wire:model.live="selected">
                </td>
                <td class="px-1 py-2">{{ $event['name'] }}</td>
                <td class="px-1 py-2">{{ $event['date'] }}</td>
                <td class="px-1 py-2">
                    <div wire:click="update_event({{ $event['id'] }})"
                        class="cursor-pointer size-4 stroke-2
                        stroke-green-500 hover:stroke-green-300 m-auto
                        transition ease-out delay-50">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title/>
                            <g id="Complete">
                                <g id="edit">
                                    <g>
                                        <path d="M20,16v4a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V6A2,2,0,0,1,4,4H8"
                                            fill="none"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                        <polygon
                                            fill="none"
                                            points="12.5 15.8 22 6.2 17.8 2 8.3 11.5 8 16 12.5 15.8"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </g>
                                </g>
                            </g>
                        </svg>
                    </div>
                </td>
                <td class="px-1 py-2">
                    <div wire:click="delete_event({{ $event['id'] }})"
                        class="cursor-pointer size-4 stroke-4 fill-red-600
                        hover:fill-red-400 m-auto transition delay-50
                        ease-out">
                        <svg viewBox="0 0 1024 1024"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zM288 512a38.4 38.4 0 0 0 38.4 38.4h371.2a38.4 38.4 0 0 0 0-76.8H326.4A38.4 38.4 0 0 0 288 512z"/>
                        </svg>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        @if($is_open)
        <div>
            Modal
        </div>
        @endif
    </div>
</div>
