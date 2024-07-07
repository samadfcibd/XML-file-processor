<?php

namespace App;

use Illuminate\Support\Collection;

interface DataParserInterface
{

    /**
     * parseData
     *
     * @param  mixed $file
     * @return Collection
     */
    public function parseData($file): Collection;
}
