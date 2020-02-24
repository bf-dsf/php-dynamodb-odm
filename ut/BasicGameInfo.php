<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 23/11/2017
 * Time: 4:42 PM
 */

namespace Darlinkster\Mlib\ODM\Dynamodb\Ut;

use Darlinkster\Mlib\ODM\Dynamodb\Annotations\Field;
use Darlinkster\Mlib\ODM\Dynamodb\Annotations\Item;

/**
 * Class BasicGameInfo
 *
 * @package Darlinkster\Mlib\ODM\Dynamodb\Ut
 * @Item(
 *     table="games",
 *     primaryIndex={"gamecode"},
 *     projected=true
 * )
 */
class BasicGameInfo
{
    /**
     * @var string
     * @Field()
     */
    protected $gamecode;
    /**
     * @var string
     * @Field()
     */
    protected $family;
    
    /**
     * @return string
     */
    public function getFamily()
    {
        return $this->family;
    }
    
    /**
     * @param string $family
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }
    
    /**
     * @return string
     */
    public function getGamecode()
    {
        return $this->gamecode;
    }
    
    /**
     * @param string $gamecode
     */
    public function setGamecode($gamecode)
    {
        $this->gamecode = $gamecode;
    }
}
