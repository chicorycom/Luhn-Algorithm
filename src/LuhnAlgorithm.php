<?php

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014 Niklas Ekman
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

declare(strict_types=1);

namespace Nekman\LuhnAlgorithm;

use Nekman\LuhnAlgorithm\Contract\LuhnAlgorithmInterface;
use Nekman\LuhnAlgorithm\Contract\NumberInterface;

/**
 * {@inheritdoc}
 */
class LuhnAlgorithm implements LuhnAlgorithmInterface
{
    /**
     * {@inheritDoc}
     */
    public function isValid(NumberInterface $number): bool
    {
        if ($number->getCheckDigit() === null) {
            throw new \InvalidArgumentException("Check digit is null.");
        }

        $checksum = $this->calcChecksum($number);
        $sum = $checksum + $number->getCheckDigit();

        // If the checksum is divisible by 10 it is valid.
        return ($sum % 10) === 0;
    }

    /**
     * {@inheritDoc}
     */
    public function calcCheckDigit(NumberInterface $number): int
    {
        $checksum = $this->calcChecksum($number);
        
        // Get the last digit of the checksum.
        $checkDigit = $checksum % 10;

        // If the check digit is not 0, then subtract the value from 10.
        return $checkDigit === 0
            ? $checkDigit
            : 10 - $checkDigit;
    }

    /**
     * {@inheritDoc}
     */
    public function calcChecksum(NumberInterface $number): int
    {
        $number = (string) $number->getNumber();
        // Need to account for the check digit.
        $nDigits = strlen($number) + 1;
        $parity = $nDigits % 2;
        $checksum = 0;

        for ($i = 0; $i < $nDigits - 1; $i++) {
            $digit = (int) $number[$i];

            // Every other digit, starting from the rightmost,
            // shall be doubled.
            if (($i % 2) === $parity) {
                $digit *= 2;

                if ($digit > 9) {
                    $digit -= 9;
                }
            }

            $checksum += $digit;
        }

        return $checksum;
    }
}
