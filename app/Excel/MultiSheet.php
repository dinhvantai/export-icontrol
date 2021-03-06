<?php


namespace App\Excel;


use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiSheet implements WithMultipleSheets
{
    protected $sheets;
    protected $allHeadings;

    public function __construct($allHeadings, $sheets)
    {
        $this->allHeadings = $allHeadings;
        $this->sheets = $sheets;
    }

    public function sheets(): array
    {
        $sheets = [];

        foreach ($this->sheets as $sheetName => $sheet) {
            $headings = array_merge(['Date Time'], $this->allHeadings[$sheetName]);
            $sheets[] = new OneSheet($headings, $sheet, $sheetName);
        }

        return $sheets;
    }
}
