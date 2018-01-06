<?php

namespace xanadu2875\getglass;

use pocketmine\plugin\PluginBase;
use pocketmine\item\Item;
use pocketmine\block\BlockIds as Ids;
use pocketmine\event as e;

class GetGlass extends PluginBase implements e\Listener
{
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
}
