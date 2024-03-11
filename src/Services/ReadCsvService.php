<?php

namespace App\Services;

use League\Csv\Reader;

/**
 * @Author Damien Vassart
 */
class ReadCsvService
{
    /**
     * @param string $path
     * @param string $filename
     * @param $delimeter
     * @return Reader
     * @throws \League\Csv\Exception
     * @throws \League\Csv\InvalidArgument
     * @throws \League\Csv\UnavailableStream
     */
    public function readCsvFile(string $path, string $filename, $delimeter = ','): Reader
    {
        $csv = Reader::createFromPath('%kernel.root_dir%/' . $path . $filename, 'r');
        $csv->setDelimiter($delimeter);
        $csv->setHeaderOffset(0);

        return $csv;
    }
}