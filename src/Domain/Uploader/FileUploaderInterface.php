<?php

namespace Domain\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface FileUploaderInterface
 * @author yourname
 */
interface FileUploaderInterface
{
    /**
     * @param UploadedFile $file
     *
     * @return string
     */
    public function upload(UploadedFile $file): string;
}
