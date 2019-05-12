<?php
namespace Infra\Uploader;

use Domain\Uploader\FileUploaderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class FileUploader implements FileUploaderInterface
{
    /** @var string */
    private $targetDirectory;

    /**
     * @param string $targetDirectory
     */
    public function __construct(string $targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * {@inheritdoc}
     */
    public function upload(UploadedFile $file): string
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();

        $file->move($this->getTargetDirectory(), $fileName);

        return $fileName;
    }

    /**
     * @return string
     */
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}
