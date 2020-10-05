<?php
namespace App\Tests\Unit\Service;

use App\Service\CalculatorService;
use PHPUnit\Framework\TestCase;

class CalculatorServiceTest extends TestCase
{
    /**
     * @dataProvider mulParams
     * @param string $a
     * @param string $b
     * @param string $expectedResult
     * @param bool   $isTrue
     */
    public function testMul(string $a, string $b, string $expectedResult, bool $isTrue): void
    {
        $calculatorService = new CalculatorService();

        $actualResult = $calculatorService->mul($a, $b);

        if ($isTrue) {
            $this->assertTrue($expectedResult == $actualResult, sprintf('%s != %s', $expectedResult, $actualResult));
        } else {
            $this->assertFalse($expectedResult == $actualResult, sprintf('%s != %s', $expectedResult, $actualResult));
        }
    }

    /**
     * @dataProvider divParams
     * @param string $a
     * @param string $b
     * @param string $expectedResult
     * @param bool   $isTrue
     */
    public function testDiv(string $a, string $b, string $expectedResult, bool $isTrue): void
    {
        $calculatorService = new CalculatorService();

        $actualResult = $calculatorService->div($a, $b);

        if ($isTrue) {
            $this->assertTrue($expectedResult == $actualResult, sprintf('%s != %s', $expectedResult, $actualResult));
        } else {
            $this->assertFalse($expectedResult == $actualResult, sprintf('%s != %s', $expectedResult, $actualResult));
        }
    }

    public function mulParams()
    {
        return [
            [2, 2, 4, true],
            [4, 4, 16, true],
            [5, 5, 26, false],
        ];
    }

    public function divParams()
    {
        return [
            [4, 2, 2, true],
            [10, 2, 5, true],
            [128, 20, 6.4, true],
            [128, 20, 6.3, false],
        ];
    }
}
