#! /usr/bin/env php
<?php
/**
 * Created by PhpStorm.
 * User: minhao
 * Date: 2016-09-03
 * Time: 17:01
 */

use BF\Mlib\ODM\Dynamodb\ItemManager;
use BF\Mlib\ODM\Dynamodb\Ut\CasDemoUser;
use BF\Mlib\ODM\Dynamodb\Ut\UTConfig;

require_once __DIR__ . "/vendor/autoload.php";

UTConfig::load();
$im = new ItemManager(
    UTConfig::$dynamodbConfig, UTConfig::$tablePrefix, __DIR__ . "/cache", true
);

//$user       = new CasDemoUser();
//$user->id   = 1;
//$user->name = 'John';
//$user->ver  = '1';
//$im->persist($user);
//$im->flush();

$user = $im->get(CasDemoUser::class, ['id' => 1]);
$user->name = 'Alice';
$user->ver = '2';
sleep(5);
$im->flush();
