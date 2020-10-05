<?php
declare(strict_types=1);

namespace App\Request\v1\History;

use App\Request\RequestDTOInterface;
use App\Request\v1\ParameterTraits\Limit;
use Symfony\Component\HttpFoundation\Request;

final class HistoryRequest implements RequestDTOInterface
{
    use Limit;

    private const LIMIT = 'limit';

    public function __construct(Request $request)
    {
        $limit = $request->query->getInt(static::LIMIT, 5);

        $this->setLimit($limit);
    }
}
