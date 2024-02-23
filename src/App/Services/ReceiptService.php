<?php

declare(strict_types=1);

namespace App\Services;

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

        $max_file_size_mb = 3 * 1024;

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
}
