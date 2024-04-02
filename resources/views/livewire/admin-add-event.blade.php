@php
    $inputs_style = 'p-1 mx-1 my-2 bg-slate-800 max-w-full grow';
    $labels_style = 'flex justify-end items-center min-w-20 text-sm';
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
        ],
        [
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

<div class="font['Montserrat'] min-w-screen min-h-screen bg-slate-800 flex
    flex-col text-xl text-slate-100 text-center py-4">

    <div class="pb-4 text-3xl font-black">
        Add Event
    </div>

    <form wire:submit="add"
        class="text-slate-100 font-bold flex flex-col grow justify-around">
        <div class="flex flex-col max-w-full">
            @foreach($form_inputs as $form_input)
            <div class="min-w-full flex">
                <label for="{{ $form_input['input_name'] }}"
                    class="{{ $labels_style }}">
                    {{ $form_input['label_name'] }}
                </label>
                <input type="{{ $form_input['input_type'] }}"
                    wire:model ="{{ $form_input['input_model'] }}"
                    name="" id="{{ $form_input['input_name'] }}" value=""
                    class="{{ $inputs_style }}">
            </div>
            @endforeach
        </div>
        <div class="flex justify-around min-w-full text-slate-100">
            <button type="submit"
                class="border-2 min-w-28 border-green-500 rounded-full font-bold
                transition ease-out delay-50 hover:bg-green-500
                hover:text-slate-800">
                Add
            </button>
            <button type="reset"
                class="border-2 min-w-28 border-red-500 rounded-full font-bold
                transition ease-out delay-50 hover:bg-red-500
                hover:text-slate-800">
                Clear
            </button>
        </div>
    </form>

</div>
