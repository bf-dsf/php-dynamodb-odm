<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 2017-05-11
 * Time: 21:58
 */

namespace BF\Mlib\ODM\Dynamodb\Ut;

use BF\Mlib\ODM\Dynamodb\Annotations\Field;
use BF\Mlib\ODM\Dynamodb\Annotations\Index;
use BF\Mlib\ODM\Dynamodb\Annotations\Item;

/**
 * Class CasDemoUser
 *
 * @Item(
 *     table="cas-demo-users",
 *     primaryIndex=@Index(hash="id")
 *     )
 * @package BF\Mlib\ODM\Dynamodb\Ut
 */

class CasDemoUser
{
    /**
     * @var int
     * @Field(type="number", name="uid")
     */
    public $id = 0;
    /**
     * @var
     * @Field(type="string")
     */
    public $name;
    /**
     * @var
     * @Field(type="string", cas="enabled")
     */
    public $ver;
}
