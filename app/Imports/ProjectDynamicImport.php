<?php

namespace App\Imports;

use App\Factory\ProjectDynamicFactory;
use App\Factory\ProjectFactory;
use App\Models\FailedRow;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Validators\Failure;

class ProjectDynamicImport implements ToCollection, SkipsOnFailure, WithValidation, WithStartRow, WithEvents
{
    use RegistersEventListeners;
    private Task $task;
    private static array $headings;
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
        $typesMap = $this->getTypesMap(Type::all());

        foreach ($collection as $row) {

            if (!isset($row[1])) continue;

            $rowMap = $this->getRowsMap($row);

            $projectFactory = ProjectDynamicFactory::make($typesMap, $rowMap['static']);

            $project = Project::updateOrCreate([
                'type_id' => $projectFactory->getValues()['type_id'],
                'title' => $projectFactory->getValues()['title'],
                'date_of_create' => $projectFactory->getValues()['date_of_create'],
                'contracted_at' => $projectFactory->getValues()['contracted_at'],
            ], $projectFactory->getValues());


            if (!isset($rowMap['dynamic'])) continue;

            foreach ($rowMap['dynamic'] as $key => $value) {
                Payment::create([
                    'project_id' => $project->id,
                    'title' => self::$headings[$key],
                    'value' => $value,
                ]);
            }
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

    private function getRowsMap($row)
    {
        $static = [];
        $dynamic = [];
        foreach ($row as $key => $value) {
            if ($value) {
                $key > 12 ? $dynamic[$key] = $value : $static[$key] = $value;
            }
        }

        return [
            'static' => $static,
            'dynamic' => $dynamic,
        ];
    }

    private function getDynamicRulesArray() :array
    {
        $headers = $this->getRowsMap(self::$headings)['dynamic'];

        foreach ($headers as $key => $value) {
            $headers[$key] = 'required|integer';
        }

        return $headers;
    }

    public function rules(): array
    {
        return array_replace([
            '0' => 'required|string',
            '1' => 'required|string',
            '2' => 'required|integer',
            '9' => 'required|integer',
            '3' => 'nullable|string',
            '4' => 'nullable|integer',
            '5' => 'nullable|string',
            '6' => 'nullable|string',
            '7' => 'nullable|integer',
            '8' => 'nullable|string',
            '10' => 'nullable|integer',
            '11' => 'nullable|string',
            '12' => 'nullable|numeric'
        ], $this->getDynamicRulesArray());

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

    public function startRow(): int
    {
        return 2;
    }

    public static function beforeSheet(BeforeSheet $event)
    {
        self::$headings = $event->getSheet()->getDelegate()->toArray()[0];
    }


}
