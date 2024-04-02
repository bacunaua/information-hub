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
    public $selected = [];
    public $select_all_checkbox = false;
    public $holidays = [];
    public $events = [];
    public $selected_count;
    public $single_id;

    public function mount(): void
    {
        $this->fetch_events();
    }

    public function check_select_all(): void
    {
        $this->select_all_checkbox = false;
    }

    public function open_add_event(): void
    {
        $this->is_add_event_open = true;
    }

    public function open_confirm($id): void
    {
        $this->is_confirmation_open = true;
        $this->selected_count = count($this->selected);
        $this->single_id = $id;
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
        if (empty($this->selected))
        {
            EventModel::destroy($this->single_id);
        }
        EventModel::destroy(array_values($this->selected));
        $this->selected = [];
        $this->fetch_events();
    }

    public function delete_holiday(): void
    {
    }

    public function update_event(): void
    {
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
