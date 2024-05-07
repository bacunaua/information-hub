<?php

namespace App\Livewire;

use App\Models\EventModel;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class AdminAddEvent extends Component
{
    #[Validate('required',
        message: 'Please provide a name for this event')]
    public $name;

    #[Validate('required',
        message: 'Please provide a date for this event')]
    public $date;

    #[Validate('required',
        message: 'Please provide a location for this event')]
    public $location;

    public $time;

    public $info;
    public $host;
    public $success_popup = false;

    public function add(): void
    {
        $this->validate();
        EventModel::create([
            'name' => $this->name,
            'host' => $this->host,
            'date' => $this->date,
            'time' => $this->time,
            'location' => $this->location,
            'info' => $this->info,
        ]);
        $this->dispatch('close_popup');
        $this->success_popup = true;
    }

    #[On('close_popup')]
    public function close_popup(): void
    {
        sleep(1);
        $this->success_popup = false;
    }

    #[Title('Add Event')]
    public function render()
    {
        return view('livewire.admin-add-event');
    }
}
