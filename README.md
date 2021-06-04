# LibSkinUtils
A pocketmine library for validating and converting png's to usable skins.

# Features
- Ability to check whether the skin is a valid size.
- Convert skin png's to skin data.
- Convert skin data to an actual skin.

# Examples
```php
<?php

declare(strict_types = 1);

namespace TPE\Example;

use TPE\LibSkinUtils\LibSkinUtils
use pocketmine\entity\Human;
use pocketmine\level\Level;
use pocketmine\nbt\tag\CompoundTag;
use TPE\Example\Main;

class Example extends Human {

   public function __construct(Level $level, CompoundTag $nbt) {
       $path = Main::get()->getDataFolder() . DIRECTORT_SEPERATOR . "example.png"; // example.png represents the example skin.
       $data = LibSkinUtils::getSkinDataFromPng($path); // simply gets the skin data required for skin conversion
       if(LibSkinUtils::preValidateSkin($data)) { // checks if skin is an acceptable size.
           $this->setSkin(LibSkinUtils::createSkin($data)); // creates a skin object from data
       } else {
          throw new \Exception("Invalid skin size used!");
       }
   }    
}
```

# Upcoming features
- Ability to apply capes to the skin.
