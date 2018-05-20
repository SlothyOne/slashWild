<?php

namespace slashWild;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\level\{Level,Position,ChunkManager};
use pocketmine\math\Vector3;
use pocketmine\event\entity\EntityDamageEvent;

class Wild extends PluginBase implements Listener{

	public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool{
		switch(strtolower($cmd->getName())){
			case "wild":
				if($sender->hasPermission("slashWild.command.wild")) {
					if($sender instanceof Player) {
						$x = rand(-3000,3000);
            					$y = 95; //not too high and not too low to sufficate!
						$z = rand(-3000,3000);
						$sender->teleport($sender->getLevel()->getSafeSpawn(new Vector3($x, $y, $z)));
						$sender->sendTip("You've been teleported somewhere wild!");
						$sender->sendMessage("teleporting to: X-$x Z-$z");
					}
					else {
						$sender->sendMessage("[slashWild] Only in-game!");
					}
				}
				else {
					$sender->sendMessage("You have no permission to use this command!");
				}
				return true;
			break;

		}
	}
	
	public function onFall(EntityDamageEvent $event){
    	$level = $event->getEntity()->getLevel();
        $levelname = $level->getFolderName();
        if($event->getCause() === EntityDamageEvent::CAUSE_FALL){
        $event->setCancelled();
       }
}
	
	public function onDisable() {
		$this->getLogger()->info("slashWild has been disabled!");
	}

}
