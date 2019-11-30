<?php

namespace Spatie\Searchable;

class SearchResult
{
    /** @var \Spatie\Searchable\Searchable */
    public $searchable;

    /** @var string */
    public $title;

    /** @var null|string */
    public $url;
    /** @var null|string */
    public $image;
    /** @var null|int */
    public $userId;
    /** @var null|bool */
    public $follows;
    /** @var null|bool */
    public $friend;
    /** @var null|bool */
    public $accept;

    /** @var string */
    public $type;

    public function __construct(Searchable $searchable, string $title, ?string $url = null,
                                ?string $image,?int $userId,?bool $follows,?bool $friend,?bool $accept)
//    public function __construct(Searchable $searchable, string $title, ?string $url = null)
    {
        $this->searchable = $searchable;

        $this->title = $title;

        $this->url = $url;

        $this->image = $image;
        $this->userId = $userId;
        $this->follows = $follows;
        $this->friend = $friend;
        $this->accept = $accept;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }
}
