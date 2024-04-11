<?php

namespace App\Livewire;

use App\Models\EventModel;
use App\Models\HolidayModel;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;

    public $is_confirmation_open = false;
    public $is_add_event_open = false;
    public $is_edit_event_open = false;
    public $selected = [];
    public $select_all_checkbox = false;
    public $holidays = [];
    public $events = [];
    public $events_to_update = [];
    public $individual_id;
    public $key;
    public $single_event_for_deletion;

    public function mount(): void
    {
        $this->fetch_events();
    }

    public function check_select_all(): void
    {
        if (count($this->selected) < count($this->events))
        {
            $this->select_all_checkbox = false;
        }
        else
        {
            $this->select_all_checkbox = true;
        }
    }

    public function open_edit_event(): void
    {
        $this->is_edit_event_open = true;
    }

    public function open_add_event(): void
    {
        $this->is_add_event_open = true;
    }

    public function open_delete_event_confirmation($id): void
    {
        if ($id)
        {
            $this->single_event_for_deletion = EventModel::find($id);
            $this->individual_id = $id;
        }
        $this->is_confirmation_open = true;
    }

    public function close_edit_event(): void
    {
        $this->is_edit_event_open = false;
    }

    public function close_add_event(): void
    {
        $this->is_add_event_open = false;
    }

    public function close_confirm(): void
    {
        $this->is_confirmation_open = false;
    }

    public function toggle_select_all(): void
    {
        for($i = 0; $i < count($this->events); $i++)
        {
            if ($this->select_all_checkbox)
            {
                $this->selected[$i] = $this->events[$i]['id'];
            }
            else
            {
                $this->selected = [];
            }
        }
    }

    public function delete_event(): void
    {
        EventModel::destroy($this->individual_id);
        $this->fetch_events();
    }

    public function delete_event_selected(): void
    {
        EventModel::destroy(array_values($this->selected));
        $this->selected = [];
        $this->fetch_events();
    }

    public function delete_holiday(): void
    {
    }

    public function update_event($id): void
    {
        if (empty($this->selected))
        {
            $this->selected[] = $id;
        }
        $this->events_to_update = EventModel::whereIn('id',
                                        $this->selected)->get();
        $this->open_edit_event();
    }

    public function update_holiday(): void
    {
    }

    public function fetch_events(): void
    {
        $this->events = EventModel::all();
    }

    public function fetch_holidays(): void
    {
        $this->events = HolidayModel::all();
    }

    public function render()
    {
        return view('livewire.admin');
    }
}
