<?php

class FileUpload {

    private array $allowedMimeTypes = ["image/jpeg", "image/png", "image/jpg"];
    private $fileToUpload;
    private string $destination;
    private int $maxFileSize = 2;

    /**
     * FileUpload constructor.
     * @param $file
     * @param string $destination
     * @param int $maxFileSize
     */
    public function __construct($file, string $destination, int $maxFileSize = 2) {
        $this->fileToUpload = $file;
        $this->destination = $destination;
        $this->maxFileSize = $maxFileSize * 1024 * 1024;
        if(strrpos($this->destination, '/') === 0) {
            $this->destination = $this->destination . '/';
        }
    }


    /**
     * Upload the file and return true in case of succes, false otherwise.
     * @return bool
     */
    public function upload(): bool {
        if ($this->fileToUpload['error'] === 0 && $this->isAllowedMimeType($this->fileToUpload['type'])) {
            $tmp_name = $this->fileToUpload["tmp_name"];
            $name = $this->getRandomName($this->fileToUpload["name"]);
            return move_uploaded_file($tmp_name, $this->destination . $name);
        }

        return false;
    }

    /**
     * Return true if file does not exceed the maximum allowed size.
     * @return bool
     */
    public function isSizeInThreshold(): bool {
        return (int)$this->fileToUpload["size"] <= $this->maxFileSize;
    }

    /**
     * Return true if provided mime type is allowed to be uploaded.
     * @param string $mimetype
     * @return bool
     */
    public function isAllowedMimeType(string $mimetype): bool {
        return in_array($mimetype, $this->allowedMimeTypes);
    }


    /**
     * Return a random file name.
     * @param string $fileName
     * @return string
     */
    public function getRandomName(string $fileName): string {
        // Getting file extension.
        $info = pathinfo($fileName);
        try {
            // Generate a random string (size :20)
            $bytes = random_bytes(20);
        }
        catch (Exception $exception) {
            $bytes = openssl_random_pseudo_bytes(20);
        }
        return bin2hex($bytes) .'.' . $info['extension'];
    }
}