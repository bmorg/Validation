<?php

/*
 * This file is part of Respect/Validation.
 *
 * (c) Alexandre Gomes Gaigalas <alexandre@gaigalas.net>
 *
 * For the full copyright and license information, please view the "LICENSE.md"
 * file that was distributed with this source code.
 */

namespace Respect\Validation\Rules;

class Sorted extends AbstractRule
{
    public function __construct(callable $fn = null, bool $ascending = true)
    {
        $this->fn = $fn ?? function($x){ return $x;};
        $this->ascending = $ascending;
    }

    public function validate($input)
    {
        $count = count($input);
        if($count < 2){
            return true;
        };
        for($i = 1; $i < $count; $i++){
            $cmp = $this->ascending === true
                ? ($this->fn)($input[$i]) >= ($this->fn)($input[$i - 1])
                : ($this->fn)($input[$i]) <= ($this->fn)($input[$i - 1]);
            if($cmp === false) return false;
        }
        return true;
    }
}
