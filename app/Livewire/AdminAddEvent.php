<?php

namespace App\Livewire;

use App\Models\EventModel;
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

    public function add(): void
    {
        $this->validate();

        EventModel::create([
            'name' => $this->name,
            'date' => "{$this->date} {$this->time}",
            'location' => $this->location,
            'info' => $this->info,
        ]);
    }

    #[Title('Add Event')]
    public function render()
    {
        return view('livewire.admin-add-event');
    }
}
