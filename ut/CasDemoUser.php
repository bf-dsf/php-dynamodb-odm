<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 2017-05-11
 * Time: 21:58
 */

namespace Darlinkster\Mlib\ODM\Dynamodb\Ut;

use Darlinkster\Mlib\ODM\Dynamodb\Annotations\Field;
use Darlinkster\Mlib\ODM\Dynamodb\Annotations\Index;
use Darlinkster\Mlib\ODM\Dynamodb\Annotations\Item;

/**
 * Class CasDemoUser
 *
 * @Item(
 *     table="cas-demo-users",
 *     primaryIndex=@Index(hash="id")
 *     )
 * @package Darlinkster\Mlib\ODM\Dynamodb\Ut
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
