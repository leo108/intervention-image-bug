<?php
use Intervention\Image\ImageManager;

require __DIR__.'/vendor/autoload.php';

// Make sure output directory exists
if (!is_dir(__DIR__.'/output')) {
    mkdir(__DIR__.'/output', 0777, true);
}

$playButtonPath = './play_button.png';
$previewPath = './original.png';
$resizedPlayButtonPath = './resized_play_button.png';

$round = 20;

for($i=0;$i<$round;$i++) {
    ImageManager::gd()->read($playButtonPath)->resize(84, 84)->toPng()->save($resizedPlayButtonPath);

    $previewRes = ImageManager::gd()->read($previewPath)->resize(600, 300);
    $previewRes->toPng()->save("./output/preview_{$i}.png");

    $playButtonRes = ImageManager::gd()->read($resizedPlayButtonPath);
    $previewRes->place($playButtonRes, 'center')->toPng()->save("./output/preview_with_play_{$i}.png");

    unlink($resizedPlayButtonPath);
}
