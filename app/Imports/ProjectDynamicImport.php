<?php

namespace App\Imports;

use App\Factory\ProjectFactory;
use App\Models\FailedRow;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;

class ProjectDynamicImport implements ToCollection, SkipsOnFailure
{
    private Task $task;
    const STATIC_ROW = 12;

    public function __construct($task)
    {
        $this->task = $task;
    }


    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        //$typesMap = $this->getTypesMap(Type::all());

        foreach ($collection as $row) {
        dd($row);
            if (!isset($row[1])) continue;

            $projectFactory = ProjectFactory::make($typesMap, $row);

            Project::updateOrCreate([
                'type_id' => $projectFactory->getValues()['type_id'],
                'title' => $projectFactory->getValues()['title'],
                'date_of_create' => $projectFactory->getValues()['date_of_create'],
                'contracted_at' => $projectFactory->getValues()['contracted_at'],
            ], $projectFactory->getValues());


        }
    }

    private function getTypesMap($types)
    {
        $map = [];
        foreach ($types as $type) {
            $map[$type->title] = $type->id;
        }

        return $map;
    }

    public function rules(): array
    {
        return [
            'tip' => 'required|string',
            'naimenovanie' => 'required|string',
            'data_sozdaniia' => 'required|integer',
            'podpisanie_dogovora' => 'required|integer',
            'setevik' => 'nullable|string',
            'kolicestvo_ucastnikov' => 'nullable|integer',
            'nalicie_autsorsinga' => 'nullable|string',
            'nalicie_investorov' => 'nullable|string',
            'dedlain' => 'nullable|integer',
            'sdaca_v_srok' => 'nullable|string',
            'vlozenie_v_pervyi_etap' => 'nullable|integer',
            'vlozenie_vo_vtoroi_etap' => 'nullable|integer',
            'vlozenie_v_tretii_etap' => 'nullable|integer',
            'vlozenie_v_cetvertyi_etap' => 'nullable|integer',
            'kolicestvo_uslug' => 'nullable|integer',
            'kommentarii' => 'nullable|string',
            'znacenie_effektivnosti' => 'nullable|numeric'
        ];

    }

    public function onFailure(Failure ...$failures)
    {
        $map = [];
        foreach ($failures as $failure) {
            foreach ($failure->errors() as $error) {
                $map[] = [
                    'message' => $error,
                    'key' => $failure->attribute(),
                    'row' => $failure->row(),
                    'task_id' => $this->task->id,
                ];
            };
        }

        if (count($map) > 0) FailedRow::insertRows($map, $this->task);
    }
}
