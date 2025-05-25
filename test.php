<?php
use Intervention\Image\ImageManager;

require __DIR__.'/vendor/autoload.php';

$previewPath = './original.png';

$round = 20;

for($i=0;$i<$round;$i++) {
    $previewRes = ImageManager::imagick()->read($previewPath)->resize(600, 300);
    $previewRes->toPng(false, true)->save("./output/preview_{$i}.png");
}
