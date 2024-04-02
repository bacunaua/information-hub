@php
    $headers = ['Name', 'Date']
@endphp
<div class="max-h-screen bg-slate-800 flex justify-center font['Montserrat']">
    <div class="flex flex-col justify-center text-center text-slate-100
        py-4 md:w-3/4">
        <div class="sm:mb-4 pb-4 sm:pb-6 font-extrabold text-2xl flex flex-col
            justify-between sm:flex-row">
            <div class="grow text-center">
                Manage Events
            </div>
            <div class="flex justify-center items-center">
                <button wire:click="open_add_event"
                    class="p-1 text-slate-200 border-2 border-green-500
                    rounded-full px-3 text-sm hover:bg-green-400 transition
                    delay-50 ease-out hover:text-slate-800"
                >
                    Add Event
                </button>
            </div>
        </div>
        <div class="basis-5/6 overflow-scroll text-xs sm:text-base font['Montserrat']">
            <table class="min-w-full cursor-default border-spacing-0
                border-separate">
                <thead class="sticky top-0 bg-slate-700 font-bold z-10">
                    <tr class="">
                        <td class="border-slate-600 align-middle border-b-2">
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
                            Actions
                        </td>
                    </tr>
                </thead>

                <tbody>
                @foreach($events as $event)
                <tr class="">
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
                        <div wire:click="open_confirm({{ $event['id'] }})"
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
        <div wire:click="close_confirm"
            class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-white
            z-20 flex justify-center items-center">
                <div class="opacity-100 rounded-xl h-auto w-4/5 sm:w-3/4
                    bg-slate-800 shadow-2xl p-4 flex flex-col items-center
                    justify-center md:w-2/3">
                    <div class="m-1 p-4 font-bold sm:text-3xl">
                    @if($selected_count < 2)
                        {{ 'Are you sure you want to delete this event?' }}
                    @else
                        {{ "Deleting $selected_count selected events.
                        Are you sure?" }}
                    @endif
                    </div>
                    <div class="flex flex-col sm:flex-row items-center
                        justify-around min-w-full">
                        <div wire:click="delete_event"
                            class="font-black text-sm rounded-full border-2
                            border-red-600 p-2 my-2 max-w-72 min-w-32
                            transition ease-out delay-50 hover:bg-red-600
                            hover:text-slate-800 cursor-pointer
                            sm:text-xl">
                            Delete
                        </div>
                        <div class="font-black text-sm rounded-full border-2
                            border-green-600 p-2 my-2 max-w-72 min-w-32
                            transition ease-out delay-50 hover:bg-green-600
                            hover:text-slate-800 cursor-pointer
                            sm:text-xl">
                            Cancel
                        </div>
                    </div>
                </div>
        </div>
        @endif
        @if($is_add_event_open)
        <div wire:click="close_add_event"
            class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-white
            z-20 flex justify-center items-center">
            <div class="opacity-100 rounded-xl h-auto w-4/5 sm:w-3/4
                bg-slate-800 shadow-2xl p-4 flex flex-col items-center
                justify-center md:w-2/3">
                <div>
                    Form
                </div>
                <div class="flex flex-col sm:flex-row items-center
                    justify-around min-w-full">
                    <div class="font-black text-sm rounded-full border-2
                        border-green-600 p-2 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-green-600
                        hover:text-slate-800 cursor-pointer
                        sm:text-xl">
                        Add Event
                    </div>
                    <div wire:click="close_add_event"
                        class="font-black text-sm rounded-full border-2
                        border-red-600 p-2 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-red-600
                        hover:text-slate-800 cursor-pointer
                        sm:text-xl">
                        Cancel
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
