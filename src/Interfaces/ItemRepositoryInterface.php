<?php

namespace Darlinkster\Mlib\ODM\Dynamodb\Interfaces;

use Darlinkster\Mlib\AwsWrappers\DynamoDbIndex;

interface ItemRepositoryInterface
{
    public function get($keys,
                        $isConsistentRead = false);

    public function query($conditions,
                          array $params,
                          $indexName = DynamoDbIndex::PRIMARY_INDEX,
                          $filterExpression = '',
                          &$lastKey = null,
                          $evaluationLimit = 30,
                          $isConsistentRead = false,
                          $isAscendingOrder = true);

    public function queryAll($conditions = '',
                             array $params = [],
                             $indexName = DynamoDbIndex::PRIMARY_INDEX,
                             $filterExpression = '',
                             $isConsistentRead = false,
                             $isAscendingOrder = true);

    public function scan($conditions = '',
                         array $params = [],
                         $indexName = DynamoDbIndex::PRIMARY_INDEX,
                         &$lastKey = null,
                         $evaluationLimit = 30,
                         $isConsistentRead = false,
                         $isAscendingOrder = true);

    public function scanAll($conditions = '',
                            array $params = [],
                            $indexName = DynamoDbIndex::PRIMARY_INDEX,
                            $isConsistentRead = false,
                            $isAscendingOrder = true,
                            $parallel = 1);

    public function scanCount($conditions = '',
                              array $params = [],
                              $indexName = DynamoDbIndex::PRIMARY_INDEX,
                              $isConsistentRead = false,
                              $parallel = 10);

    public function persist($obj);

    public function flush();

    public function clear();

    public function remove($obj);
}
