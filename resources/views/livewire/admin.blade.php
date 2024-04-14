@php
    $headers = ['Name', 'Date'];
    $updatable_cols = ['Name' => 'name',
        'Location' => 'location',
        'Host' => 'host']
@endphp
<div class="min-h-screen bg-slate-800 flex justify-center font['Montserrat']">
    <div class="flex flex-col justify-around text-center text-slate-100
        py-4 w-[90%] gap-4 max-h-screen">
        <div class="font-extrabold text-2xl flex flex-row justify-center">
            Manage Events
        </div>
        <div class="flex flex-col sm:flex-row gap-4 justify-center
            items-center">
            <a wire:navigate href="/admin_add_event"
                class="p-1 text-slate-200 border-2 border-blue-500
                rounded-full px-3 text-sm hover:bg-blue-500 transition
                delay-50 ease-out hover:text-slate-950"
            >
                Add Event
            </a>
            <button wire:click="update_event_selected"
                class="p-1 text-slate-200 border-2 border-green-500
                rounded-full px-3 text-sm hover:bg-green-500 transition
                delay-50 ease-out hover:text-slate-950">
                Update {{ count($selected) }}
                {{ count($selected) == 1 ? 'item' : 'items' }} selected
            </button>
            <button wire:click="open_delete_event_confirmation"
                class="p-1 text-slate-200 border-2 border-red-500
                rounded-full px-3 text-sm hover:bg-red-500 transition
                delay-50 ease-out hover:text-slate-950">
                Delete {{ count($selected) }}
                {{ count($selected) == 1 ? 'item' : 'items' }} selected
            </button>
        </div>
        <div class="overflow-scroll text-xs sm:text-base font['Montserrat']
            h-3/4">
            <table class="min-w-full cursor-default border-spacing-0
                border-separate">
                <thead class="sticky top-0 bg-slate-950 font-bold z-10">
                    <tr class="">
                        <td class="border-slate-600 align-middle border-b-2
                            min-w-12">
                            <input
                                wire:model.live="select_all_checkbox"
                                wire:click="toggle_select_all"
                                type="checkbox">
                        </td>
                        @foreach($headers as $header)
                            <td class="p-2 border-slate-600 border-b-2">
                                {{ $header }}
                            </td>
                        @endforeach
                        <td colspan="2" class="p-2 border-slate-600
                            border-b-2">
                            Row Actions
                        </td>
                    </tr>
                </thead>

                <tbody>
                @foreach($events as $index => $event)
                <tr class="odd:bg-slate-900 even:bg-slate-850">
                    <td class="border-b-2 border-slate-500 align-middle">
                        <input type="checkbox"
                            value="{{ $event['id'] }}"
                            wire:click="check_select_all"
                            wire:model.live="selected">
                    </td>
                    <td class="border-b-2 border-slate-500 px-1 py-2">
                        {{ $event['name'] }}
                    </td>
                    <td class="border-b-2 border-slate-500 px-1 py-2">
                        {{ $event['date'] }}</td>
                    <td class="border-b-2 border-slate-500 px-1 py-2">
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
                    <td class="border-b-2 border-slate-500 px-1 py-2">
                        <div wire:click="open_delete_event_confirmation({{$event['id']}})"
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
        </div>
        @if($is_confirmation_open)
        <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-white
            z-20 flex justify-center items-center">
            <div class="opacity-100 rounded-xl h-auto w-[95%]
                bg-slate-800 shadow-2xl p-4 flex flex-col items-center
                justify-center z-40 max-h-[90%]">
                <div class="cursor-default p-4 font-bold">
                    Deleting the following events:
                </div>
                <div class="overflow-scroll min-w-full">
                    <ul class="text-center italic">
                        @foreach($events_selected as $event)
                            <li>{{ $event['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex flex-col sm:flex-row items-center
                    justify-around min-w-full">
                    <div wire:click="delete_event_selected"
                        class="font-black text-sm rounded-full border-2
                        border-red-600 p-2 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-red-600
                        hover:text-slate-950 cursor-pointer
                        md:text-xl">
                        Delete
                    </div>
                    <div wire:click="close_confirm"
                        class="font-black text-sm rounded-full border-2
                        border-green-600 p-2 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-green-600
                        hover:text-slate-950 cursor-pointer
                        md:text-xl">
                        Cancel
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($is_edit_event_open)
        <div class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-white
            z-20 flex justify-center items-center">
            <div class="opacity-100 rounded-xl h-auto max-h-[90%] w-[95%]
                bg-slate-800 shadow-2xl p-4 flex flex-col items-center
                justify-between gap-4">
                <div class="text-2xl font-black p-1">
                    Edit
                </div>
                <div class="font-bold min-w-full overflow-scroll">
                    @foreach($events_selected as $event)
                    <form class="">
                        <div class="text-lg pb-2">
                            ID: {{ $event['id'] }}
                        </div>
                        <div class="text-sm mb-8">
                            @foreach($updatable_cols as $col_name => $col_var)
                            <div class="flex items-center text-middle mb-2">
                                <label for="{{ $col_var . $event['id'] }}"
                                    class="min-w-16 text-right">
                                    {{ $col_name }}
                                </label>
                                <input type="text" name=""
                                    id="{{ $col_var . $event['id'] }}"
                                    value="{{ $event[$col_var] }}"
                                    class="bg-slate-700 text-slate-100 grow
                                        w-1/6 mx-2 p-1">
                            </div>
                            @endforeach
                        </div>
                    </form>
                    @endforeach
                </div>
                <div class="flex flex-col sm:flex-row items-center
                    justify-around min-w-full">
                    <div wire:click
                        class="font-black text-sm rounded-full border-2
                        border-green-600 p-1 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-green-600
                        hover:text-slate-950 cursor-pointer
                        md:text-xl">
                        Update
                    </div>
                    <div wire:click="close_edit_event"
                        class="font-black text-sm rounded-full border-2
                        border-red-600 p-1 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-red-600
                        hover:text-slate-950 cursor-pointer
                        md:text-xl">
                        Cancel
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
