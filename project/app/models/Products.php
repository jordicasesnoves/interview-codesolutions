<?php

use Phalcon\Mvc\MongoCollection;

class Products extends MongoCollection
{
    /**
     * @var string
     */
    public $ref;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $image;

    /**
     * @var string
     */
    public $description;

    /**
     * @var float
     */
    public $price;

    public function initialize()
    {
        $this->ensureIndex();
        $this->setSource('products');
    }

    public function ensureIndex()
    {
        $connection = $this->getConnection();
        $collection = $connection->selectCollection($this->getSource());
        $collection->createIndex(
            ['ref' => 1],
            ['unique' => true]
        );

        $collection->createIndex(
            ['url' => 1],
            ['unique' => true]
        );
    }

}