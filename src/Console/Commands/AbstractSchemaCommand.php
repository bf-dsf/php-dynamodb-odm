<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 2016-09-18
 * Time: 18:35
 */

namespace BF\Mlib\ODM\Dynamodb\Console\Commands;

use BF\Mlib\ODM\Dynamodb\Exceptions\NotAnnotatedException;
use BF\Mlib\ODM\Dynamodb\ItemManager;
use BF\Mlib\ODM\Dynamodb\ItemReflection;
use Symfony\Component\Console\Command\Command;

abstract class AbstractSchemaCommand extends Command
{
    /** @var  ItemManager */
    protected $itemManager;
    
    /**
     * @param ItemManager $itemManager
     *
     * @return AbstractSchemaCommand
     */
    public function withItemManager($itemManager)
    {
        $this->itemManager = $itemManager;
        
        return $this;
    }
    
    /**
     * @return ItemManager
     */
    public function getItemManager()
    {
        return $this->itemManager;
    }
    
    /**
     * @return ItemReflection[]
     */
    protected function getManagedItemClasses()
    {
        $classes = [];
        foreach ($this->itemManager->getPossibleItemClasses() as $class) {
            try {
                $reflection = $this->itemManager->getItemReflection($class);
            } catch (NotAnnotatedException $e) {
                continue;
            } catch (\ReflectionException $e) {
                continue;
            } catch (\Exception $e) {
                mtrace($e, "Annotation parsing exceptionf found: ", 'error');
                throw $e;
            }
            $classes[$class] = $reflection;
        }
        
        return $classes;
    }
}
