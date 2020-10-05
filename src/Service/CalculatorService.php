<?php
declare(strict_types=1);

namespace App\Service;

use App\Exception\CalculatorException;

class CalculatorService
{
    public const DEFAULT_RESULT_PRECISION = 8;

    /**
     * @param string $a
     * @param string $b
     * @param int    $precision
     * @return string
     * @throws CalculatorException
     */
    public function add(string $a, string $b, int $precision = self::DEFAULT_RESULT_PRECISION): string
    {
        try {
            return bcadd($a, $b, $precision);
        } catch (\Throwable $e) {
            throw new CalculatorException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $a
     * @param string $b
     * @param int    $precision
     * @return string
     * @throws CalculatorException
     */
    public function sub(string $a, string $b, int $precision = self::DEFAULT_RESULT_PRECISION): string
    {
        try {
            return bcsub($a, $b, $precision);
        } catch (\Throwable $e) {
            throw new CalculatorException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $a
     * @param string $b
     * @param int    $precision
     * @return string
     * @throws CalculatorException
     */
    public function div(string $a, string $b, int $precision = self::DEFAULT_RESULT_PRECISION): string
    {
        try {
            return bcdiv($a, $b, $precision);
        } catch (\Throwable $e) {
            throw new CalculatorException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $a
     * @param string $b
     * @param int    $precision
     * @return string
     * @throws CalculatorException
     */
    public function mul(string $a, string $b, int $precision = self::DEFAULT_RESULT_PRECISION): string
    {
        try {
            return bcmul($a, $b, $precision);
        } catch (\Throwable $e) {
            throw new CalculatorException($e->getMessage(), $e->getCode());
        }
    }
}
