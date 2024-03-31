<?php

namespace App\Livewire;

use App\Models\EventModel;
use DateTimeImmutable;
use Livewire\Component;

class Calendar extends Component
{
    public $days = [];
    public $month_name;
    public $month;
    public $year;
    public $base_date;
    public $selected_date;
    public $events = [];
    public $first_day_weekday;
    private $today_date;
    private $day_offset = 0;

    public function mount(): void
    {
        $this->today_date = new DateTimeImmutable();
        $this->selected_date = $this->today_date;
        $this->base_date = new DateTimeImmutable("first day of this month");
        $this->calculate_days();
    }

    public function fetch_events($date): void
    {
        $this->selected_date = new DateTimeImmutable($date);
        $this->events = EventModel::whereDate('date',
            $this->selected_date->format('Y-m-d'))->get();
        $this->dispatch('events-fetched', $this->events);
    }

    private function cal_days_in_month(): string
    {
        return $this->base_date->modify('last day of this month')->format('d');
    }

    private function calculate_days(): void
    {
        $this->first_day_weekday = $this->base_date->format('w');
        $this->month_name = $this->base_date->format('F');
        $this->month = $this->base_date->format('m');
        $this->year = $this->base_date->format('Y');
        $this->days = [];
        $max_row = ceil(($this->cal_days_in_month() +
                         $this->first_day_weekday) / 7);
        for ($row = 0; $row < $max_row; ++$row) {
            $this->days[$row] = [];
            for ($col = 0; $col < 7; ++$col) {
                $day_offset = $col + $row * 7 - $this->first_day_weekday;
                $this->days[$row][$col] = $this->base_date
                                            ->modify("{$day_offset} day");
            };
        };
    }

    public function prev_month(): void
    {
        $this->base_date = $this->base_date->modify('-1 month');
        $this->calculate_days();
    }

    public function next_month(): void
    {
        $this->base_date = $this->base_date->modify('+1 month');
        $this->calculate_days();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
};
