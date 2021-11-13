<?php

namespace App\DataTables;

use App\Models\Ticket;

/**
 * Class TicketDataTable
 */
class TicketDataTable
{
    /**
     * @return Ticket
     */
    public function get()
    {
        /** @var Ticket $query */
        $query = Ticket::query()->select('tickets.*');

        return $query;
    }
}
