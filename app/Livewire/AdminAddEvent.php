<?php

namespace App\Livewire;

use App\Models\EventModel;
use Livewire\Attributes\Title;
use Livewire\Component;

class AdminAddEvent extends Component
{
    public $name;
    public $date;
    public $location;
    public $host;
    public $time;
    public $info;

    public function add(): void
    {
        EventModel::create([
            'name' => $this->name,
            'date' => $this->date,
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
