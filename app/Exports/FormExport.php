<?php

namespace App\Exports;

use App\FormDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use App\FormBoolean;
use Illuminate\Support\Facades\DB;

class FormExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function collection()
    {
        $forms = DB::table('form_details')
            ->join('form_booleans', 'form_booleans.form_details_id', '=', 'form_details.id')
            ->select('form_details.*', 'form_booleans.*')
            ->get();

        return $forms;
    }
}