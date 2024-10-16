<?php

namespace app\Factory;

use app\Model\Image;
use DateTime;

class ImageFactory
{

    public function createImage(
        string $imageName,
        string $imageTmpName,
        string $imageType,
        int    $imageSize): Image
    {
        return new Image($imageName, $imageTmpName, $imageType, $imageSize);
    }
}