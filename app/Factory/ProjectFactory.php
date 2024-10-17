<?php

namespace App\Factory;

use App\Models\Type;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ProjectFactory
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
    private $paymentFirstStep;
    private $paymentSecondStep;
    private $paymentThirdStep;
    private $paymentFourthStep;
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
     * @param $paymentFirstStep
     * @param $paymentSecondStep
     * @param $paymentThirdStep
     * @param $paymentFourthStep
     * @param $comment
     * @param $effectively
     */
    public function __construct($typeId, $title, $contractedAt, $dateOfCreate, $deadline, $isChain, $isOnTime, $hasOutsource, $hasInvestors, $workerCount, $serviceCount, $paymentFirstStep, $paymentSecondStep, $paymentThirdStep, $paymentFourthStep, $comment, $effectively)
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
        $this->paymentFirstStep = $paymentFirstStep;
        $this->paymentSecondStep = $paymentSecondStep;
        $this->paymentThirdStep = $paymentThirdStep;
        $this->paymentFourthStep = $paymentFourthStep;
        $this->comment = $comment;
        $this->effectively = $effectively;
    }

    public static function make($typesMap, $row)
    {
        return new self(
            self::getTypeId($typesMap, $row['tip']),
            $row['naimenovanie'],
            Date::excelToDateTimeObject($row['podpisanie_dogovora']),
            Date::excelToDateTimeObject($row['data_sozdaniia']),
            isset($row['dedlain']) ? Date::excelToDateTimeObject($row['dedlain']) : null,
            isset($row['setevik']) ? self::getBool($row['setevik']) : null,
            isset($row['sdaca_v_srok']) ? self::getBool($row['sdaca_v_srok']) : null,
            isset($row['nalicie_autsorsinga']) ? self::getBool($row['nalicie_autsorsinga']) : null,
            isset($row['nalicie_investorov']) ? self::getBool($row['nalicie_investorov']) : null,
            $row['kolicestvo_ucastnikov'] ?? null,
            $row['kolicestvo_uslug'] ?? null,
            $row['vlozenie_v_pervyi_etap'] ?? null,
            $row['vlozenie_vo_vtoroi_etap'] ?? null,
            $row['vlozenie_v_tretii_etap'] ?? null,
            $row['vlozenie_v_cetvertyi_etap'] ?? null,
            $row['kommentarii'] ?? null,
            $row['znacenie_effektivnosti'] ?? null,
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
