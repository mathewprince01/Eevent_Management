<?php

namespace App\Exports;

use App\Models\Speaker;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class SpeakerExport implements FromCollection,WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public $session;
    public function __construct($session)
    {
        $this->session = $session;
    }
    public function collection()
    {
        return $this->session;
    }
    public function map($session): array
    {
        return [
            $session->speaker->name,
            $session->session_title,
            $session->start_time,
            $session->end_time,
        ];
    }
    public function headings(): array
    {
        return [
            'Speaker Name',
            'Session Title',
            'Start Time',
            'End Time'
        ];
    }
}
