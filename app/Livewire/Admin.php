<?php

namespace App\Livewire;

use App\Models\EventModel;
use App\Models\HolidayModel;
use Livewire\Component;
use Livewire\WithPagination;

class Admin extends Component
{
    use WithPagination;

    public $is_open = false;
    public $selected = [];
    public $select_all_checkbox = false;
    public $holidays = [];
    public $events = [];

    public function mount(): void
    {
        $this->fetch_events();
    }

    public function check_select_all(): void
    {
        $this->select_all_checkbox = false;
    }

    public function confirm(): void
    {
        $this->is_open = !$this->is_open;
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

    public function delete_event($id): void
    {
        if (empty($this->selected))
        {
            EventModel::destroy($id);
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
