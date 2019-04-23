<?php

namespace UI\Actions;

/**
 * Class IndexAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class IndexAction extends BaseAction
{
    /**
     * @return Response
     */
    public function __invoke()
    {
        return $this->render('homepage.html.twig');
    }
}
