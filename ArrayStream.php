<?php

// File: ArrayStream.php

class ArrayStream
{
    private static array $dataStore = []; // global shared memory
    private string $path = '';
    private int $position = 0;

    public function stream_open(string $path, string $mode, int $options, ?string &$opened_path): bool
    {
        $this->path = parse_url($path, PHP_URL_HOST) ?: 'default';

        if (!isset(self::$dataStore[$this->path])) {
            self::$dataStore[$this->path] = '';
        }

        if (str_contains($mode, 'w')) {
            self::$dataStore[$this->path] = ''; // reset if opened for writing
        }

        $this->position = 0;
        return true;
    }

    public function stream_read(int $count): string
    {
        $data = substr(self::$dataStore[$this->path], $this->position, $count);
        $this->position += strlen($data);
        return $data;
    }

    public function stream_write(string $data): int
    {
        $left  = substr(self::$dataStore[$this->path], 0, $this->position);
        $right = substr(self::$dataStore[$this->path], $this->position + strlen($data));

        self::$dataStore[$this->path] = $left . $data . $right;
        $written = strlen($data);
        $this->position += $written;

        return $written;
    }

    public function stream_tell(): int
    {
        return $this->position;
    }

    public function stream_eof(): bool
    {
        return $this->position >= strlen(self::$dataStore[$this->path]);
    }

    public function stream_seek(int $offset, int $whence = SEEK_SET): bool
    {
        $length = strlen(self::$dataStore[$this->path]);
        switch ($whence) {
            case SEEK_SET:
                if ($offset >= 0 && $offset <= $length) {
                    $this->position = $offset;
                    return true;
                }
                return false;
            case SEEK_CUR:
                $new = $this->position + $offset;
                if ($new >= 0 && $new <= $length) {
                    $this->position = $new;
                    return true;
                }
                return false;
            case SEEK_END:
                $new = $length + $offset;
                if ($new >= 0 && $new <= $length) {
                    $this->position = $new;
                    return true;
                }
                return false;
        }
        return false;
    }

    public function stream_stat(): array
    {
        return [
            'size' => strlen(self::$dataStore[$this->path]),
        ];
    }

    // Helper for debugging: read raw storage
    public static function dump(): array
    {
        return self::$dataStore;
    }
}

// Register wrapper once
if (!in_array('array', stream_get_wrappers())) {
    stream_wrapper_register('array', ArrayStream::class);
}

// ------------------------
// USAGE EXAMPLE (CLI demo)
// ------------------------
if (PHP_SAPI === 'cli' && basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'])) {
    $fp = fopen("array://demo", "w+");


    fwrite($fp, "Hello ");
    fwrite($fp, "World!");

    rewind($fp);

    echo fread($fp, 1024), "\n";  // "Hello World!"

    fseek($fp, -6, SEEK_END);
    fwrite($fp, "PHP");

    rewind($fp);
    echo fread($fp, 1024), "\n";  // "Hello PHP"

    print_r(ArrayStream::dump());
}
