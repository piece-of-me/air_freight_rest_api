<?php

namespace App\Helpers;

class CSVFileReader
{
    /** @var resource */
    private $file;

    /** @throws \Exception */
    public function __construct(string $path)
    {
        if (!file_exists($path)) {
            throw new \Exception('File "' . $path . '" does not exist');
        }
        $this->file = fopen($path, 'r');
    }

    public function rows(): \Generator
    {
        while (($buffer = fgetcsv($this->file)) !== false) {
            yield $buffer;
        }
    }

    public function chunk(int $size = 10): \Generator
    {
        while (true) {
            $chunk = [];
            for ($i = 0; $i < $size; $i++) {
                if (($buffer = fgetcsv($this->file)) === false) {
                    if (sizeof($chunk) <= 0) break 2;
                    yield $chunk;
                    break 2;
                } else {
                    $chunk[] = $buffer;
                }
            }
            yield $chunk;
        }
    }

    public function __destruct()
    {
        fclose($this->file);
    }
}
