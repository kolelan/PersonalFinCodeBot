<?php

namespace App;

/**
 * Class FinCodeHandler производит расчёт персонального финансового кода и антикода
 */
class FinCodeHandler
{
    /**
     * Возвращает персональный финансовый код
     * @param $date - дата в формате dd.mm.yyyy
     * @return string|void
     */
    public static function getPersonalCode($date)
    {
        try{
            if(strpos($date,'.')){
                $dataArray = explode('.',$date);
                return self::calcPersonalCode($dataArray);
        }
        }catch (\Exception $e){
            return 'xxxx (что-то не так)';
        }
    }

    /**
     * Производит расчёт финансового кода из массива
     * @param array $dataArray - массив представляющий дату в формате [dd,mm,yyyy]
     * @return string - числовой код
     */
    private static function calcPersonalCode(array $dataArray)
    {
        $first = self::calcCode((int)$dataArray[0]);
        $second = self::calcCode((int)$dataArray[1]);
        $third = self::calcCode((int)$dataArray[2]);
        $fourth = self::calcCode((int)($first + $second + $third));
        return (string) $first.$second.$third.$fourth;
    }

    /**
     * Метод, который складывает цифры составляющие число
     * @param int $number - любое целое число
     * @return int - сумма чисел составляющих число
     */
    private static function calcCode(int $number)
    {
        if(strlen($number)==1) return $number;
        return self::calcCode(array_sum(str_split($number)));
    }

    /**
     * Рассчитывает антикод
     * @param $number
     * @return int|int
     */
    public static function getAntiCode($number)
    {
        return self::calcCode((int)$number) - 1;
    }
}