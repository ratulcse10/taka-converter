<?php

namespace Ratul\TakaConverter;


class NumberConverter extends AbstractConverter {

    public function convert()
    {
        return $this->amount;
    }
}
