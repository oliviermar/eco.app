<?php

namespace UI\Actions;

use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Abstract class BaseAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
abstract class BaseAction
{
    /** @var EngineInterface */
    protected $twig;

    /** @var MessageBusInterface */
    protected $bus;

    /** @var RouterInterface */
    protected $router;

    /**
     * @param EngineInterface     $twig
     * @param MessageBusInterface $bus
     * @param RouterInterface     $router
     */
    public function __construct(EngineInterface $twig, MessageBusInterface $bus, RouterInterface $router)
    {
        $this->twig = $twig;
        $this->bus = $bus;
        $this->router = $router;
    }

    /**
     * @param string $name
     * @param array  $params
     *
     * @return Response
     */
    public function render(string $name, array $params = []): Response
    {
        return new Response($this->twig->render($name, $params));
    }

    /**
     * @param string $route
     * @param array  $parameters
     * @param int    $status
     *
     * @return RedirectResponse
     */
    public function redirectToRoute(string $route, array $parameters = [], int $status = 302): RedirectResponse
    {
        return new RedirectResponse($this->generateUrl($route, $parameters), $status);
    }

    /**
     * @param string $route
     * @param array  $parameters
     * @param int    $referenceType
     *
     * @return string
     */
    public function generateUrl(string $route, array $parameters = [], int $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH): string
    {
        return $this->router->generate($route, $parameters, $referenceType);
    }
}
