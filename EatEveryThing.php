<?php

/*
__PocketMine Plugin__
name=EatEveryThing
description=eat anything
version=1
author=Swagboy47
class=Eat
apiversion=11,12
*/
class Eat implements Plugin{
	private $api;
	private $enabled = true;
	private $ops = true;
	public function __construct(ServerAPI $api, $server = false){
		$this->api = $api;
	}

	public function init(){
	  $this->api->console->register("eatmode", "to enable and disable eatmode", array($this, "CommandHandler"));
    $this->api->console->alias("em","eatmode");
    $this->api->event("player.action", array($this, "action"));
}
 public function CommandHandler($cmd, $params, $issuer, $alias)
 {
        switch(strtolower($cmd))
        {
            case "eatmode":
                if(!($issuer instanceof Player)){
                  return "[ERROR] [EatMode] Please run this command in-game!";
                }
                if($params[0] == "on"){
                  if($this->enabled === true){
                     $issuer->sendChat("[EatMode] EatMode Notify is already on!");
                  }
                  if($this->enabled === false){
                     $issuer->sendChat("[EatMode] EatMode is on!");
                     $this->enabled = true;
                }
                }
                  elseif($params[0] == "off"){
                    if($this->enabled === false){
                      $issuer->sendChat("[EatMode] EatMode Notify is already off!");
                  }
                  if($this->enabled === true){
                      $issuer->sendChat("[EatMode] EatMode is off!");
                      $this->enabled = false;
                }
                  }
                   
                   	
                   
        }
 }
 public function action($data, $event) {
 		switch ($event) {
 			case "player.action":
 			  if($this->enabled == true){
 				$player = $data["player"];
 				$item = $player->getSlot($player->slot);
 				$item1 = $data["item"];
 				$item2 = $item1->count()
 				$item3 = $item1->getID();
 				if($item->getID() === BUCKET and $item->getMetaData() === WATER and $player->entity->getHealth() < 20) {
 					$player->entity->heal(10, "drinking");
 					$player->setSlot($player->slot, BlockAPI::getItem(BUCKET, AIR, 1));
 				}
 				if($item->getID() === BUCKET and $item->getMetaData() === LAVA) {
 					$player->entity->fire = 20 * 20;
				  $player->entity->updateMetadata();
 					$player->setSlot($player->slot, BlockAPI::getItem(BUCKET, AIR, 1));
 				}
 				if($item1->getID() === 57 and $item2 =< 4) {
 					$player->setArmor(0,$this->api->block->getItem(310));
 					$player->setArmor(1,$this->api->block->getItem(311));
 				        $player->setArmor(2,$this->api->block->getItem(312));
 				        $player->setArmor(3,$this->api->block->getItem(313));
 					$player->setSlot($player->slot,$item2-4);
 				}
 				
 			  //it's not done yet :)
 				
 				
 				
