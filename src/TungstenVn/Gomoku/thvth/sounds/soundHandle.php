<?php

namespace TungstenVn\Gomoku\thvth\sounds;

use TungstenVn\Gomoku\thvth\gameHandle\gameHandle;
use TungstenVn\Gomoku\thvth\sounds\delayedSound;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;
class soundHandle {


    public $owner;
    public function __construct(gameHandle $owner) {
      $this->owner = $owner;
    }
    public function sound1($player) {
      $this->livingRoom($player, "game.player.attack.strong");
    }
    public function sound2($player) {
      $this->livingRoom($player, "game.player.hurt");
    }
    public function sound3($player) {
      $this->livingRoom($player, "mob.cat.meow");
    }
    public function losingSound($player) {
      $this->livingRoom($player, "mob.enderdragon.death");
      $this->livingRoom($player, "mob.endermen.scream");
    }
    public function illigelMoveSound($player) {
      $this->livingRoom($player, "mob.horse.angry");
    }
    public function onTurn($player) {
      $this->livingRoom($player, "bubble.pop");
    }
    public function livingRoom($player, $txt) {
      $sound = new PlaySoundPacket();
      $sound->x = $player->getX();
      $sound->y = $player->getY();
      $sound->z = $player->getZ();
      $sound->volume = 1;
      $sound->pitch = 1;
      $sound->soundName = $txt;
      $this->owner->owner->main->getServer()->broadcastPacket([$player], $sound);
    }
    public function winningSound($player) {
      $this->owner->owner->main->getScheduler()->scheduleDelayedTask(new delayedSound($this, $player), 1);
      $this->owner->owner->main->getScheduler()->scheduleDelayedTask(new delayedSound($this, $player), 20);
      $this->owner->owner->main->getScheduler()->scheduleDelayedTask(new delayedSound($this, $player), 40);
    }
}