<?php

declare(strict_types = 1);

namespace TPE\LibSkinUtils;

use pocketmine\entity\Skin;

class LibSkinUtils {

    /**
     * @param string $path
     * @return string
     *
     * Returns skin data required for creating a skin.
     */
    public static function getSkinDataFromPNG(string $path) : string {
        $image = imagecreatefrompng($path);
        $data = "";
        for($y = 0, $height = imagesy($image); $y < $height; $y++) {
            for($x = 0, $width = imagesx($image); $x < $width; $x++) {
                $color = imagecolorat($image, $x, $y);
                $data .= pack("c", ($color >> 16) & 0xFF)
                    . pack("c", ($color >> 8) & 0xFF)
                    . pack("c", $color & 0xFF)
                    . pack("c", 255 - (($color & 0x7F000000) >> 23));
            }
        }
        return $data;
    }

    /**
     * @param string $skinData
     * @param bool $check
     * @return Skin
     *
     * Returns a skin object, null is returned if $check is true and the skin size is invalid.
     */
    public static function createSkin(string $skinData, $check = true) : ?Skin {
        if($check) {
            if(self::preValidateSkin($skinData)) {
                return new Skin("Standard_Custom", $skinData, "", "geometry.humanoid.custom");
            } 
            return null;
        }
        return new Skin("Standard_Custom", $skinData, "", "geometry.humanoid.custom");
    }
    
    /**
    * @param string $skinData
    * @return bool
    *
    * Returns true depending on whether or not the skin is a valid size.
    */
    public static function preValidateSkin(string $skinData) : bool {
        if(in_array(strlen($skinData), Skin::ACCEPTED_SKIN_SIZES)) {
            return true;
        } else {
            return false;
        }
    }
}
