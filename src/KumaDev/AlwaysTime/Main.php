<?php

namespace KumaDev\AlwaysTime;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\scheduler\Task;

class Main extends PluginBase {

    /** @var Config */
    private $config;

    public function onEnable(): void {
        $this->saveDefaultConfig();
        $this->config = $this->getConfig();
        $this->getScheduler()->scheduleRepeatingTask(new AlwaysTimeTask($this), 40);
    }

    public function getSetTime(): int {
        $setTime = $this->config->get("set-time", "day");
        $addTimes = $this->config->get("add-time", []);
        
        if (isset($addTimes[$setTime])) {
            return (int) $addTimes[$setTime];
        }
        
        $this->getLogger()->warning("Invalid set-time value in config.yml, defaulting to day.");
        return 1000; // Default to day time
    }

    public function isWorldAllowed(string $worldName): bool {
        $mode = $this->config->get("mode", "whitelist");
        $worlds = $this->config->get("worlds", []);
        
        if ($mode === "allworlds") {
            return true;
        } elseif ($mode === "whitelist") {
            return in_array($worldName, $worlds);
        } elseif ($mode === "blacklist") {
            return !in_array($worldName, $worlds);
        }
        
        return false;
    }
}

class AlwaysTimeTask extends Task {

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onRun(): void {
        $setTime = $this->plugin->getSetTime();
        foreach ($this->plugin->getServer()->getWorldManager()->getWorlds() as $world) {
            if ($this->plugin->isWorldAllowed($world->getFolderName()) && $world->getTime() !== $setTime) {
                $world->setTime($setTime);
            }
        }
    }
}
