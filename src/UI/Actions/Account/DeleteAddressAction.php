<?php

namespace UI\Actions\Account;

use UI\Actions\BaseAction;
use App\Command\DeleteAddressCommand;

/**
 * Class DeleteAddressAction
 *
 * @author Olivier Maréchal <o.marechal@wakeonweb.com>
 */
class DeleteAddressAction extends BaseAction
{
    public function __invoke(string $id)
    {
        $this->bus->dispatch(DeleteAddressCommand::fromId($id));

        return $this->redirectToRoute('account_detail');
    }
}
