<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectDynamicFactory
{
    private $typeId;
    private $title;
    private $contractedAt;
    private $dateOfCreate;
    private $deadline;
    private $isChain;
    private $isOnTime;
    private $hasOutsource;
    private $hasInvestors;
    private $workerCount;
    private $serviceCount;
    private $comment;
    private $effectively;

    /**
     * @param $typeId
     * @param $title
     * @param $contractedAt
     * @param $dateOfCreate
     * @param $deadline
     * @param $isChain
     * @param $isOnTime
     * @param $hasOutsource
     * @param $hasInvestors
     * @param $workerCount
     * @param $serviceCount
     * @param $comment
     * @param $effectively
     */
    public function __construct($typeId, $title, $contractedAt, $dateOfCreate, $deadline, $isChain, $isOnTime, $hasOutsource, $hasInvestors, $workerCount, $serviceCount, $comment, $effectively)
    {
        $this->typeId = $typeId;
        $this->title = $title;
        $this->contractedAt = $contractedAt;
        $this->dateOfCreate = $dateOfCreate;
        $this->deadline = $deadline;
        $this->isChain = $isChain;
        $this->isOnTime = $isOnTime;
        $this->hasOutsource = $hasOutsource;
        $this->hasInvestors = $hasInvestors;
        $this->workerCount = $workerCount;
        $this->serviceCount = $serviceCount;
        $this->comment = $comment;
        $this->effectively = $effectively;
    }

    public static function make($typesMap, $row)
    {
        return new self(
            self::getTypeId($typesMap, $row[0]),
            $row[1],
            Date::excelToDateTimeObject($row[9]),
            Date::excelToDateTimeObject($row[2]),
            isset($row[7]) ? Date::excelToDateTimeObject($row[7]) : null,
            isset($row[3]) ? self::getBool($row[3]) : null,
            isset($row[8]) ? self::getBool($row[8]) : null,
            isset($row[5]) ? self::getBool($row[5]) : null,
            isset($row[6]) ? self::getBool($row[6]) : null,
            $row[4] ?? null,
            $row[10] ?? null,
            $row[11] ?? null,
            $row[12] ?? null,
        );
    }

    public function getValues()
    {
        $props = get_object_vars($this);
        $res = [];
        foreach ($props as $key => $value) {
            $res[Str::snake($key)] = $value;
        }

        return $res;
    }

    private static function getTypeId($typesMap, $typeTitle)
    {
        return $typesMap[$typeTitle] ?? Type::create(['title' => $typeTitle])->id;
    }

    private static function getBool($item): bool
    {
        return $item === 'Да';
    }
}
