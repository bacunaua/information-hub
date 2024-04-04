<?php

namespace App\Livewire;

use App\Models\EventModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminAddEvent extends Component
{
    #[Validate('required', message: 'Please provide the name of this event')]
    public $name;

    #[Validate('required', message: 'Please provide the date of this event')]
    public $date;

    #[Validate('required',
        message: 'Please provide the location of this event')]
    public $location;
    public $host;
    public $time;
    public $info;
    public $success_popup = false;

    public function add(): void
    {
        $this->validate();
        EventModel::create([
            'name' => $this->name,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'info' => $this->info,
        ]);
        $this->success_popup = true;
    }

    public function close_popup(): void
    {
        $this->success_popup = false;
    }

    #[Title('Add Event')]
    public function render()
    {
        return view('livewire.admin-add-event');
    }
}
