<?php


namespace App\Excel;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OneSheet implements WithHeadings, FromArray, WithTitle
{
    protected $headings;
    protected $data;
    protected $title;

    public function __construct($headings, $data, $title)
    {
        $this->headings = $headings;
        $this->data = $data;
        $this->title = $title;
    }

    public function headings() : array
    {
        return $this->headings;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function title(): string
    {
        return $this->title;
    }
}
