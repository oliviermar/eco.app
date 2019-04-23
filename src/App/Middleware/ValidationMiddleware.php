<?php

namespace App\Middleware;

use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ValidationMiddleware
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class ValidationMiddleware implements MiddlewareInterface
{
    /** @var ValidatorInterface */
    private $validator;

    /**
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        $errors = $this->validator->validate($envelope->getMessage());
        if (count($errors) > 0) {
            throw new BadRequestHttpException('Validation failed');
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
