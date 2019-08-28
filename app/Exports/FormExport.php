<?php

namespace App\Exports;

use App\FormDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\FormBoolean;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;


class FormExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $forms = DB::table('form_details')
            ->join('form_booleans', 'form_booleans.form_details_id', '=', 'form_details.id')
            ->select('form_details.id', 'form_booleans.form_details_id', 'form_booleans.gen1_oil', 'form_booleans.gen2_oil')
            ->get();

        return $forms;
    }
    public function headings(): array
    {
        return [
            "#",
            'Site Ref',
            'Site Type',
            'Date and Time',
            'Cluster Engineer',
            'Checkman',
            'Site With Single Gen',
            'S/N Gen1',
            'S/N Gen2',
            'Gen1 Type',
            'Gen1 Size',  
            'Gen2 Type',            
            'Gen2 Size',            
            'Gen1 Status',            
            'Gen2 Status',            
            'Gen1 R.Hours',            
            'Gen2 R.Hours',            
            'Gen1 Oil',            
            'Gen1 Oil Hours',            
            'Gen2 Oil',            
            'Gen2 Oil Hours',            
            'Gen1 Oil Filter',            
            'en2 Oil Filter',            
            'Gen1 Fuel Filter',            
            'Gen2 Fuel Filter',            
            'Gen1 Lift Pump Filter',            
            'Gen2 Lift Pump Filter',            
            'Gen1 Air Filter',            
            'Gen2 Air Filter',            
            'Gen1 Clean',            
            'Gen2 Clean',            
            'Gen1 Radiator Clean',            
            'Gen2 Radiator Clean',            
            'Gen1 Sensors Status',            
            'Gen2 Sensors Status',            
            'Gen1 Charging Issue',            
            'Gen2 Charging Issue',            
            'Engine Smoke Ok',            
            'Engine Smoke White',            
            'Engine Smoke Black',            
            'Oil Leakage Ok',            
            'Oil Leakage Filter',            
            'Oil Leakage Case',            
            'Oil Leakage Pump',            
            'Oil Leakage drain',            
            'Oil Valve Cover',            
            'Oil Leakage Seal',            
            'Water Leakage Ok',            
            'Water Leakage Radiator',            
            'Water Leakage Fils',            
            'Water Leakage Radiator Join',            
            'Water Leakage Pump',            
            'Fuel Leakage Ok',            
            'Fuel Leakage Nozzle',            
            'Fuel Leakage Pipe Valve',            
            'Fuel Leakage Tube',            
            'Fuel Leakage Filter',            
            'Fuel Tank CM',            
            'Fuel Tank Piping',            
            'Fuel Tank Pipe Valves',            
            'Fuel Tank Drain',            
            'ATS Board Clean',            
            'MDB Board Clean',            
            'ATS Board Status',            
            'PLC Board Status',            
            'ATS Contactor Status',            
            'Relay And Timer Status Status',            
            'MDB Board Status',            
            'Surge Arrestor Status',            
            'Phase Failure Status',            
            'RBS CB Status',            
            'RBS Heat Exchanger',            
            'RBS Battery 1 Set',            
            'RBS Battery 2 sets',            
            'RBS Door Sensor',            
            'RBS Dummy',            
            'CLU Status',            
            'Fire Extiguisher',            
            'Flexible Tube Status',            
            'Lights Status',            
            'Emergency Lights Status',            
            'No of PSUs/PDUs',            
            'Commercial Power',            
            'Commercial Power Amperes',            
            'Commercial Power CP Readings',            
            'External Power',            
            'External Power Amperes',            
            'Exceeding Power',      
            'Exceeding Power Amperes',            
            'AC Status',            
            'AC Type',            
            'AC Size',            
            'AC Control Status',            
            'AC Control clean',            
            'AC Control Site Clean',            
            'Alarm Door Sensor Clean OK',            
            'Alarm Door Sensor Clean Not OK',            
            'Alarm Generator OK',            
            'Alarm Generator Not OK',            
            'External Alarm Status Ok',            
            'External Alarm Status Not Ok',      
            'Comments',            
            'General Notes'
        ];
    }
}