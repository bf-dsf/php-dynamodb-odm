<?php

namespace BF\Mlib\ODM\Dynamodb\Interfaces;

use BF\Mlib\AwsWrappers\DynamoDbIndex;

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

    public function queryBatch($conditions,
                               array $params,
                               $indexName = DynamoDbIndex::PRIMARY_INDEX,
                               $filterExpression = '',
                               &$lastKey = null,
                               $evaluationLimit = 30,
                               $isConsistentRead = false,
                               $isAscendingOrder = true,
                               $concurrency = 10,
                               $retryDelay = 0,
                               $maxDelay = 15000);

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

    public function reloadByPrimaryKeys($obj);

    public function queryCount($conditions,
                               array $params,
                               $indexName = DynamoDbIndex::PRIMARY_INDEX,
                               $filterExpression = '',
                               $isConsistentRead = false);

    public function multiQueryCount($hashKey,
                                    $hashKeyValues,
                                    $rangeConditions,
                                    array $params,
                                    $indexName,
                                    $filterExpression = '',
                                    $isConsistentRead = false,
                                    $concurrency = 10);

    public function refresh($obj, $persistIfNotManaged = false);

    public function batchGet($groupOfKeys,
                             $isConsistentRead = false,
                             $indexName = DynamoDbIndex::PRIMARY_INDEX,
                             $concurrency = 10,
                             $retryDelay = 0,
                             $maxDelay = 15000);
}
