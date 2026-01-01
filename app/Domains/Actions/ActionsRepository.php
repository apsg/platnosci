<?php
namespace App\Domains\Actions;

use App\Domains\Actions\Exceptions\InvalidActionException;
use App\Domains\Actions\Models\Action;
use App\Domains\Sales\Models\Sale;

class ActionsRepository
{
    public function create(Sale $sale, string $action): Action
    {
        if (!ActionsHelper::isValidAction($action)) {
            throw new InvalidActionException($action);
        }

        return Action::create([
            'sale_id' => $sale->id,
            'type'    => Action::TYPE_SUCCESS,
            'job'     => config("integrations.{$action}.job"),
        ]);
    }
}
