<?php

namespace ChangeLog;

use \Exception;

class Formatter
{
    private $filename;

    public function __construct(?string $filename = null)
    {
        $filename = $filename ?? getenv('CHANGELOG_FILENAME');
        if (!$filename) {
            throw new Exception('Filename is required or env CHANGELOG_FILENAME');
        }
        $this->setFilename($filename);
    }

    public function getLastVersion()
    {
        $file = file($this->getFilename());
        foreach ($file as $line) {
            if (substr($line, 0, 3) == '## ') {
                preg_match('/\[(.*?)\]/', $line, $cortado);
                if (! is_numeric($cortado[1][0])) {
                    continue;
                }
                $version['number'] = $cortado[1];

                preg_match('/[0-9]{4}-[0-1][0-9]-[0-3][0-9]/', $line, $cortado);
                $date = $cortado[0];
                $version['date'] = new \DateTime($date);

                break;
            }
        }
        return $version ?? [];
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }

    public function setFilename(string $filename)
    {
        $this->filename = $filename;
    }
}
