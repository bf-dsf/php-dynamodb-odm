<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 2016-09-03
 * Time: 18:00
 */

namespace BF\Mlib\ODM\Dynamodb\Annotations;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Target;
use BF\Mlib\AwsWrappers\DynamoDbManager;

/**
 * Class Item
 *
 * @Annotation
 * @Target("CLASS")
 */
class Item
{
    /**
     * @var string
     * @Required()
     */
    public $table;
    /**
     * Check and set type
     *
     * @var string
     * @Enum(value={"PROVISIONED", "PAY_PER_REQUEST"})
     */
    public $billingType = DynamoDbManager::PROVISIONED;
    /**
     * @var string
     */
    public $ttlAttribute = null;
    /**
     * @var array|Index
     * @Required()
     */
    public $primaryIndex = null;
    /**
     * @var array[]|Index[]
     */
    public $globalSecondaryIndices = [];
    /**
     * @var array[]|Index[]
     */
    public $localSecondaryIndices = [];
    /**
     * @var string
     */
    public $repository;
    
    /**
     * A projected item is read-only
     *
     * @var bool
     */
    public $projected = false;
    
    public function __construct($values)
    {
        foreach ($values as $name => $value) {
            if (property_exists(self::class, $name)) {
                
                switch ($name) {
                    case 'primaryIndex':
                        if (!$value instanceof Index) {
                            $value = new Index($value);
                        }
                        break;
                    case 'globalSecondaryIndices':
                    case 'localSecondaryIndices':
                        $orig  = $value;
                        $value = [];
                        foreach ($orig as $indexValue) {
                            if (!$indexValue instanceof Index) {
                                $indexValue = new Index($indexValue);
                            }
                            $value[] = $indexValue;
                        }
                        break;
                }
                
                $this->$name = $value;
            }
        }
    }
}
