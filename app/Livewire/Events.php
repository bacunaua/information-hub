<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Events extends Component
{
    public $events = [];
    public $is_expanded = false;

    #[On('events-fetched')]
    public function update_events($events): void
    {
        $this->events = $events;
    }

    public function toggle_collapsible(): void
    {
        $this->is_expanded = !$this->is_expanded;
    }

    public function render()
    {
        return view('livewire.events');
    }
}
