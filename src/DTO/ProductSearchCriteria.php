<?php

namespace App\DTO;

class ProductSearchCriteria
{
    public int $limit = 25;

    public int $page = 1;

    public ?string $name = null;

    public string $orderBy = 'createdAt';

    public string $direction = 'DESC';

}