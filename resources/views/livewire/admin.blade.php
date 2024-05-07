@php
    $headers = ['Name', 'Date'];
    $updatable_cols = ['Name' => 'name',
        'Date' => 'date',
        'Time' => 'time',
        'Location' => 'location',
        'Host' => 'host'];
    $form_inputs = [
        [
            'label_name' => 'Name',
            'input_name' => 'name',
            'input_type' => 'text',
            'input_model' => 'name',
        ],
        [
            'label_name' => 'Location',
            'input_name' => 'location',
            'input_type' => 'text',
            'input_model' => 'location',
        ],
        [
            'label_name' => 'Host',
            'input_name' => 'host',
            'input_type' => 'text',
            'input_model' => 'host',
        ],
        [
            'label_name' => 'Date',
            'input_name' => 'date',
            'input_type' => 'date',
            'input_model' => 'date',
        ], [
            'label_name' => 'Start time',
            'input_name' => 'time',
            'input_type' => 'time',
            'input_model' => 'time',
        ],
        [
            'label_name' => 'Description',
            'input_name' => 'info',
            'input_type' => 'text',
            'input_model' => 'info',
        ],
    ];
@endphp
<div class="min-h-screen bg-slate-800 flex justify-center font['Montserrat']">
    <div class="flex flex-col justify-around text-center text-slate-100
        py-4 w-[90%] gap-4 max-h-screen">
@foreach($events as $event)
<div>{{ $event }}</div>
@endforeach
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
                Create Event
            </a>
            <button wire:click="open_update_event_confirmation"
                class="p-1 text-slate-200 border-2 border-green-500
                rounded-full px-3 text-sm hover:bg-green-500 transition
                delay-50 ease-out hover:text-slate-950">
                Update {{ count($selected_events_ids) }}
                {{ count($selected_events_ids) == 1 ? 'item' : 'items' }} selected
            </button>
            <button wire:click="open_delete_event_confirmation"
                class="p-1 text-slate-200 border-2 border-red-500
                rounded-full px-3 text-sm hover:bg-red-500 transition
                delay-50 ease-out hover:text-slate-950">
                Delete {{ count($selected_events_ids) }}
                {{ count($selected_events_ids) == 1 ? 'item' : 'items' }} selected
            </button>
        </div>
        <div class="overflow-scroll text-xs sm:text-base font['Montserrat']
            h-3/4">
            <table class="min-w-full relative cursor-default border-spacing-0
                border-separate">
                <thead class="sticky top-0 bg-slate-950 font-bold z-30">
                    <tr class="">
                        <td class="sticky z-30 left-0 border-slate-600 align-middle border-b-2
                            min-w-12 bg-slate-950 ">
                            <input
                                wire:model.live="select_all_checkbox"
                                wire:click="toggle_select_all"
                                type="checkbox">
                        </td>
                        @foreach($form_inputs as $form_input)
                            <td class="p-2 border-slate-600 border-b-2">
                                {{ $form_input['label_name'] }}
                            </td>
                        @endforeach
                        <td class="sticky right-0 p-2 border-slate-600
                            border-b-2 bg-slate-950">
                            Row Actions
                        </td>
                    </tr>
                </thead>

                <tbody>
                @foreach($events as $event)
                <tr class="hover:bg-slate-700 odd:bg-slate-900
                    even:bg-slate-800">
                    <td class="sticky z-10 left-0 border-b-2 border-slate-500 align-middle bg-inherit">
                        <div class="w-full h-full bg-inherit">
                            <input type="checkbox"
                                value="{{ $event['id'] }}"
                                wire:click="check_select_all"
                                wire:model.live="selected_events_ids">
                        </div>
                    </td>
                    @foreach($form_inputs as $form_input)
                    <td class="border-b-2 border-slate-500 px-1 py-2">
                        <div>
                        {{ $event[$form_input['input_name']] }}
                        </div>
                    </td>
                    @endforeach
                    <td class="sticky right-0 z-10 border-b-2 border-slate-500
                        px-1 py-2 bg-inherit">
                        <div class="flex">
                            <div wire:click.debounce.500ms=
                                "open_update_event_confirmation({{ $event['id'] }})"
                                class="cursor-pointer size-4 stroke-2
                                stroke-green-500 hover:stroke-green-300 m-auto
                                transition ease-out delay-50">
                                <svg viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
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
                            <div wire:click="open_delete_event_confirmation({{$event['id']}})"
                                class="cursor-pointer size-4 stroke-4
                                hover:fill-red-400 m-auto transition delay-50
                                ease-out fill-red-600">
                                <svg viewBox="0 0 1024 1024"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M512 64a448 448 0 1 1 0 896 448 448 0 0 1 0-896zM288 512a38.4 38.4 0 0 0 38.4 38.4h371.2a38.4 38.4 0 0 0 0-76.8H326.4A38.4 38.4 0 0 0 288 512z"/>
                                </svg>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @if($is_delete_event_open)
        <div wire:transition
            class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-white
            z-40 flex justify-center items-center">
            <div class="opacity-100 rounded-xl h-auto w-[95%]
                bg-slate-800 shadow-2xl p-4 flex flex-col items-center
                justify-center z-100 max-h-[90%]">
                <div class="flex align-middle w-full">
                    <div class="text-2xl font-black p-1 grow">
                        Delete
                    </div>
                    <div wire:click="close_delete_event"
                        class="fill-slate-950 p-1 bg-red-500 hover:bg-red-600
                        rounded-full cursor-pointer size-8 justify-center
                        items-center">
                        <svg viewBox="0 0 1024 1024"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"/>
                        </svg>
                    </div>
                </div>
                <div class="cursor-default p-4 font-bold">
                    Removing the following events:
                </div>
                <div class="overflow-scroll min-w-full">
                    <ul class="text-center italic">
                        @foreach($events_before_changes as $event)
                            <li>{{ $event['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="flex flex-col sm:flex-row items-center
                    justify-around min-w-full">
                    <div wire:click="confirm_delete"
                        class="font-black text-sm rounded-full border-2
                        border-red-600 p-2 my-2 max-w-72 min-w-32
                        transition ease-out delay-50 hover:bg-red-600
                        hover:text-slate-950 cursor-pointer
                        md:text-xl">
                        Delete
                    </div>
                    <div wire:click="close_delete_event"
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
        @if($is_update_event_open)
        <div wire:transition
            class="absolute top-0 left-0 w-full h-full bg-opacity-30 bg-white
            z-40 flex justify-center items-center">
            <div class="opacity-100 rounded-xl h-auto max-h-[90%] w-[95%]
                bg-slate-800 shadow-2xl p-4 flex flex-col items-center
                justify-between gap-4">
                <div class="flex align-middle w-full">
                    <div class="text-2xl font-black p-1 grow">
                        Edit
                    </div>
                    <div wire:click="close_update_event"
                        class="fill-slate-700 p-1 bg-red-500 hover:bg-red-600
                        rounded-full cursor-pointer size-8 justify-center
                        items-center">
                        <svg viewBox="0 0 1024 1024"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M195.2 195.2a64 64 0 0 1 90.496 0L512 421.504 738.304 195.2a64 64 0 0 1 90.496 90.496L602.496 512 828.8 738.304a64 64 0 0 1-90.496 90.496L512 602.496 285.696 828.8a64 64 0 0 1-90.496-90.496L421.504 512 195.2 285.696a64 64 0 0 1 0-90.496z"/>
                        </svg>
                    </div>
                </div>
                <div class="font-bold min-w-full overflow-scroll">
                    @foreach($events_before_changes as $index => $event)
                    <form wire:submit="confirm_update({{ $event['id'] }})">
                        <div class="text-lg pb-2">
                            ID: {{ $event['id'] }}
                        </div>
                        <div class="text-sm mb-8">
                            @foreach($form_inputs as $form_input)
                            <div class="flex items-center text-middle mb-2">
                                <label for="{{ $form_input['input_name'] . $event['id'] }}"
                                    class="min-w-20 text-right">
                                    {{ $form_input['label_name'] }}
                                </label>
                                <input type="{{ $form_input['input_type']}}" name=""
                                    id="{{ $form_input['input_name'] . $event['id'] }}"
                                    value="{{ $event[$form_input['input_name']] }}"
                                    wire:model.blur="events_after_changes.{{ $index }}.{{ $form_input['input_name'] }}"
                                    class="bg-slate-700 text-slate-100 grow
                                        w-1/6 mx-2 p-1">
                            </div>
                            @endforeach
                        </div>
                        @if($is_update_notif_open[$event['id']] ?? false)
                        <div wire:transition
                            class="text-green-500">
                            Updated successfully
                        </div>
                        @else
                        <div wire:transition
                            class="text-blue-500">
                            No changes&nbsp;
                        </div>
                        @endif
                        <div class="flex flex-col sm:flex-row items-center
                            justify-around min-w-full">
                            <button type="submit"
                                class="font-black text-sm rounded-full border-2
                                border-green-600 p-1 my-2 max-w-72 min-w-32
                                transition ease-out delay-50 hover:bg-green-600
                                hover:text-slate-950 cursor-pointer
                                md:text-xl">
                                Update
                            </button>
                            <button type="reset"
                                wire:click="undo_update_event(
                                    {{ $event['id'] }})"
                                class="font-black text-sm rounded-full border-2
                                border-blue-500 p-1 my-2 max-w-72 min-w-32
                                transition ease-out delay-50 hover:bg-blue-500
                                hover:text-slate-950 cursor-pointer
                                md:text-xl">
                                Reset
                            </button>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
