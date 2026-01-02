<?php

namespace App\Exports;

use App\Models\Event;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EventExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $event;
    public function __construct($event)
    {
        return $this->event = $event;
    }
    public function collection()
    {
        return $this->event;
    }
    public function headings(): array
    {
        return [
            'ID',
            'Event Title',
            'Event Type',
            'Venue',
            'Attendee Count'

        ];
    }
    public function map($event): array
    {
        return [
            $event->id,
            $event->event_title,
            $event->event_type,
            $event->venue,
            $event->registrations->sum('quantity'),
        ];
    }
}
