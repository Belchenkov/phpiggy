<?php

declare(strict_types=1);

namespace App\Services;

use App\Config\Paths;
use Framework\Database;
use Framework\Exceptions\ValidationException;

class ReceiptService
{
    public function __construct(
        private readonly Database $db,
    )
    {}

    public function validateFile(?array $file): void
    {
        if (!$file || $file['error'] !== UPLOAD_ERR_OK) {
            throw new ValidationException([
                'receipt' => ['Failed to upload file!'],
            ]);
        }

        $max_file_size_mb = 3 * 1024 * 1024;

        if ($file['size'] > $max_file_size_mb) {
            throw new ValidationException([
                'receipt' => ['File upload is too large!'],
            ]);
        }

        $original_file_name = $file['name'];

        if (!preg_match('/^[A-za-z0-9\s._-]+$/', $original_file_name)) {
            throw new ValidationException([
                'receipt' => ['Invalid filename!'],
            ]);
        }

        $client_mime_type = $file['type'];
        $allowed_mime_types = [
            'image/jpeg',
            'image/png',
            'application/pdf',
        ];

        if (!in_array($client_mime_type, $allowed_mime_types)) {
            throw new ValidationException([
                'receipt' => ['Invalid file type!'],
            ]);
        }
    }

    /**
     * @throws \Exception
     */
    public function upload(array $file): void
    {
        $file_ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $new_file_name = bin2hex(random_bytes(16)) . '.' . $file_ext;

        $upload_path = Paths::STORAGE_UPLOADS . '/' . $new_file_name;

        if (!move_uploaded_file($file['tmp_name'], $upload_path)) {
            throw new ValidationException([
                'receipt' => ['Failed to upload file!'],
            ]);
        }
    }
}
