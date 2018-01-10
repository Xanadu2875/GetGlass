<?php

namespace xanadu2875\getglass;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\block\BlockIds as Ids;
use pocketmine\event as e;
use pocketmine\utils\Utils;

class GetGlass extends PluginBase implements e\Listener
{
  public function onLoad()
  {
    if($this->checkUpdata())
    {
      $this->getServer()->getLogger()->notice("新しいバージョンがリリースされています！ ⇒ " . $this->getDescription()->getWebsite());
    }
  }

  public function onEnable() { $this->getServer()->getPluginManager()->registerEvents($this, $this); }

  public function onBreak(e\block\BlockBreakEvent $event)
  {
    switch($id = (($block = $event->getBlock())->getId()))
    {
      case Ids::GLASS:
      case Ids::GLASS_PANE:
      case Ids::STAINED_GLASS:
      case Ids::STAINED_GLASS_PANE:
        $event->setDrops([Item::get($id, $block->getDamage(), 1)]);
        break;
      default:
      break;
    }
  }

  private function checkUpdata() : bool { return str_replace("\n", "",Utils::getURL("https://raw.githubusercontent.com/Xanadu2875/VersionManager/master/GetGlass.txt" . '?' . time() . mt_rand())) === $this->getDescription()->getVersion(); }
}
