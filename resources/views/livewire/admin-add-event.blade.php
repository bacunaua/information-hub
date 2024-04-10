@php
    $inputs_style = 'p-1 ml-2 my-2 bg-slate-700 max-w-full grow
    text-slate-100 text-sm';
    $labels_style = 'cursor-none flex justify-end items-center min-w-20 text-sm
    text-slate-800';
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
            'input_model' => 'location', ],
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

<div class="font['Montserrat'] min-w-screen min-h-screen bg-slate-500 flex
    flex-col text-center">

    <div class="flex flex-col justify-center items-center grow min-h-screen
        shadow-2xl">
        <div wire:click="close_popup"
            class="absolute top-0 z-10 text-slate-100 bg-slate-800 p-4
            shadow-2xl font-bold cursor-pointer
            {{ $success_popup ? '' : 'hidden' }}">
            Event added successfully. Click to close.
        </div>
        <form wire:submit="add"
            class="text-slate-800 font-bold flex flex-col grow justify-around
            lg:w-1/2 bg-slate-300 px-2 sm:px-8">
            <div class="py-4 text-3xl font-bold sm:min-w-screen">
                Add Event
            </div>
            <div class="flex flex-col max-w-full">
                @foreach($form_inputs as $form_input)
                <div class="min-w-full flex">
                    <label for="{{ $form_input['input_name'] }}"
                        class="{{ $labels_style }}
                            @error($form_input['input_model'])
                            {{ 'text-red-700' }}
                            @enderror
                        ">
                        {{ $form_input['label_name'] }}
                    </label>
                    <input type="{{ $form_input['input_type'] }}"
                        wire:model ="{{ $form_input['input_model'] }}"
                        name="" id="{{ $form_input['input_name'] }}" value=""
                        class="{{ $inputs_style }}">
                </div>
                @endforeach
            </div>
            <div class="px-2 text-red-700 text-left text-sm">
            @foreach($form_inputs as $form_input)
                @error($form_input['input_model'])
                <div class="">
                    {{ "*$message" }}
                </div>
                @enderror
            @endforeach
            </div>
            <div class="flex justify-around min-w-full py-4 text-slate-100
                flex-col lg:flex-row gap-4">
                <button type="submit"
                    class="min-w-28 bg-slate-700 rounded-full
                    font-bold transition ease-out delay-50 hover:bg-slate-800
                    text-slate-100 p-1">
                    Add
                </button>
                <button type="reset"
                    class="min-w-28 bg-slate-600 rounded-full font-bold
                    transition ease-out delay-50 hover:bg-slate-800 p-1
                    text-slate-100">
                    Clear
                </button>
                <a href="/admin" wire:navigate
                    class="min-w-28 bg-zinc-600 rounded-full
                    font-bold transition ease-out delay-50 hover:bg-slate-800
                    text-slate-100 p-1">
                    View Events
                </a>
            </div>
        </form>
    </div>
</div>
