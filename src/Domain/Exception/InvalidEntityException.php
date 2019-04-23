<?php

namespace Domain\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class InvalidEntityException
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class InvalidEntityException extends \Exception
{
    /** @var string */
    protected $message = 'Données invalide';

    /** @var array */
    private $violations;

    /**
     * @param string $violation
     */
    public function __construct(string $violation)
    {
        $this->violations = json_decode($violation, true);
    }

    /**
     * @param ConstraintViolationListInterface $violationList
     *
     * @return self
     */
    public static function fromViolations(ConstraintViolationListInterface $violationList)
    {
        $violations = [];
        foreach ($violationList as $violation) {
            $violations[$violation->getPropertyPath()] = $violation->getMessage();
        }

        return new self(json_encode($violations));
    }

    /**
     * @return array
     */
    public function getViolations(): array
    {
        return $this->violations;
    }
}
