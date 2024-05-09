<?php

namespace App\Livewire;

use App\Models\EventModel;
use Livewire\Attributes\On;
use Livewire\Component;

class Admin extends Component
{
    public $is_delete_event_open = false;
    public $is_update_event_open = false;
    public $is_update_notif_open = [];
    public $events = [];
    public $events_before_changes = [];
    public $events_after_changes = [];
    public $selected_events_ids = [];
    public $select_all_checkbox = false;

    public function mount(): void
    {
        $this->fetch_events();
    }

    public function check_select_all(): void
    {
        if (count($this->selected_events_ids) < count($this->events))
        {
            $this->select_all_checkbox = false;
        }
        else
        {
            $this->select_all_checkbox = true;
        }
    }

    public function toggle_select_all(): void
    {
        for($i = 0; $i < count($this->events); $i++)
        {
            if ($this->select_all_checkbox)
            {
                $this->selected_events_ids[$i] = $this->events[$i]['id'];
            }
            else
            {
                $this->selected_events_ids = [];
            }
        }
    }

    public function open_update_event_confirmation(...$ids): void
    {
        foreach($ids as $id)
        {
            $this->selected_events_ids = [$id];
        }
        if(count($this->selected_events_ids) > 0)
        {
            $this->events_before_changes = EventModel::whereIn('id',
                                                $this->selected_events_ids)
                                                ->get()
                                                ->pluck(null, 'id')
                                                ->toArray();
            $this->events_after_changes = (array)$this->events_before_changes;
            $this->is_update_event_open = true;
        }
    }

    public function confirm_update($id): void
    {
        $event = EventModel::find($id);
        foreach($this->events_after_changes as $event_after_change)
        {
            if($event_after_change['id'] == $id)
            {
                $event->name = $event_after_change['name'];
                $event->location = $event_after_change['location'];
                $event->host = $event_after_change['host'];
                $event->date = $event_after_change['date'];
                $event->time = $event_after_change['time'];
                $event->info = $event_after_change['info'];
                $event->save();
            }
        }
        $this->is_update_notif_open[$id] = true;
        $this->dispatch('update_success', id: $id);
        $this->fetch_events();
    }

    #[On('update_success')]
    public function close_update_notif($id): void
    {
        sleep(1);
        $this->is_update_notif_open[$id] = false;
    }

    public function close_update_event(): void
    {
        $this->is_update_event_open = false;
        $this->selected_events_ids = [];
        $this->check_select_all();
    }

    public function undo_update_event($id): void
    {
        $event = EventModel::find($id);
        foreach($this->events_before_changes as $event_before_change)
        {
            if($event_before_change['id'] == $id)
            {
                $event->name = $event_before_change['name'];
                $event->location = $event_before_change['location'];
                $event->host = $event_before_change['host'];
                $event->save();
            }
        }
        $this->fetch_events();
    }

    public function open_delete_event_confirmation(...$ids): void
    {
        foreach($ids as $id)
        {
            $this->selected_events_ids = [$id];
        }
        if(count($this->selected_events_ids) > 0)
        {
            $this->events_before_changes = EventModel::whereIn('id',
                                                $this->selected_events_ids)
                                                ->get()
                                                ->pluck(null, 'id')
                                                ->toArray();
            $this->is_delete_event_open = true;
        }
    }

    public function confirm_delete(): void
    {
        EventModel::destroy($this->selected_events_ids);
        $this->fetch_events();
        $this->select_all_checkbox = false;
        $this->close_delete_event();
    }

    public function close_delete_event(): void
    {
        $this->selected_events_ids = [];
        $this->is_delete_event_open = false;
    }

    public function fetch_events(): void
    {
        $this->events = EventModel::all();
    }

    public function render()
    {
        return view('livewire.admin');
    }
}
