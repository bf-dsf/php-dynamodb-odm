<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 2016-09-18
 * Time: 21:19
 */

namespace BF\Mlib\ODM\Dynamodb\Annotations;

use Doctrine\Common\Annotations\Annotation\Required;
use Doctrine\Common\Annotations\Annotation\Enum;
use BF\Mlib\AwsWrappers\DynamoDbIndex;
use BF\Mlib\AwsWrappers\DynamoDbItem;
use BF\Mlib\ODM\Dynamodb\Exceptions\AnnotationParsingException;
use BF\Mlib\ODM\Dynamodb\Exceptions\ODMException;

/**
 * Class Index
 *
 * @Annotation
 * @package BF\Mlib\ODM\Dynamodb\Annotations
 */
class Index
{
    /**
     * @var string
     * @Required()
     */
    public $hash = '';

    /**
     * @var string
     */
    public $range = '';

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     * @Enum({"ALL", "INCLUDE", "KEYS_ONLY"})
     */
    public $projectionType = DynamoDbIndex::PROJECTION_TYPE_ALL;

    /**
     * @var array
     */
    public $projectedAttributes = [];
    
    public function __construct(array $values)
    {
        if (isset($values[0])) {
            $this->hash = $values[0];
            if (isset($values[1])) {
                $this->range = $values[1];
            }
            if (isset($values[2])) {
                $this->name = $values[2];
            }
            if (isset($values[3]) && in_array($values[3], DynamoDbIndex::getSupportedProjectionTypes(), true)) {
                $this->projectionType = $values[3];
            }
            if (isset($values[4]) && is_array($values[4]) && $this->projectionType === DynamoDbIndex::PROJECTION_TYPE_INCLUDE) {
                $this->projectedAttributes = $values[4];
            }

        }
        elseif (isset($values['hash'])) {
            $this->hash = $values['hash'];
            if (isset($values['range'])) {
                $this->range = $values['range'];
            }
            if (isset($values['name'])) {
                $this->name = $values['name'];
            }
            if (isset($values['projectionType']) && in_array($values['projectionType'], DynamoDbIndex::getSupportedProjectionTypes(), true)) {
                $this->projectionType = $values['projectionType'];
            }
            if (isset($values['projectedAttributes']) && is_array($values['projectedAttributes']) && $this->projectionType === DynamoDbIndex::PROJECTION_TYPE_INCLUDE) {
                $this->projectedAttributes = $values['projectedAttributes'];
            }
        }
        else {
            throw new AnnotationParsingException("Index must be constructed with an array of hash and range keys");
        }
    }
    
    public function getKeys()
    {
        $ret = [
            $this->hash,
        ];
        if ($this->range) {
            $ret[] = $this->range;
        }
        
        return $ret;
    }
    
    public function getDynamodbIndex(array $fieldNameMapping, array $attributeTypes)
    {
        $hash  = $fieldNameMapping[$this->hash];
        $range = $this->range ? $fieldNameMapping[$this->range] : '';
        
        if (!isset($attributeTypes[$hash])
            || ($range && !isset($attributeTypes[$range]))
        ) {
            throw new ODMException("Index key is not defined as Field!");
        }
        
        $hashType  = $attributeTypes[$hash];
        $rangeKey  = $range ? : null;
        $rangeType = $range ? $attributeTypes[$range] : 'string';
        $hashType  = constant(DynamoDbItem::class . '::ATTRIBUTE_TYPE_' . strtoupper($hashType));
        $rangeType = constant(DynamoDbItem::class . '::ATTRIBUTE_TYPE_' . strtoupper($rangeType));
        $projectionType = $this->projectionType;
        $projectedAttributes = $this->projectedAttributes;

        $idx       = new DynamoDbIndex($hash, $hashType, $rangeKey, $rangeType, $projectionType, $projectedAttributes);
        if ($this->name) {
            $idx->setName($this->name);
        }
        
        return $idx;
    }
}
