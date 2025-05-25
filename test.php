<?php
use Intervention\Image\ImageManager;

require __DIR__.'/vendor/autoload.php';

// Make sure output directory exists
if (!is_dir(__DIR__.'/output')) {
    mkdir(__DIR__.'/output', 0777, true);
}

$playButtonPath = './play_button.png';
$previewPath = './original.png';
$resizedPlayButtonPath = './resized_play_button.webp';

$round = 20;

for($i=0;$i<$round;$i++) {
    ImageManager::imagick()->read($playButtonPath)->resize(84, 84)->toWebp()->save($resizedPlayButtonPath);

    $previewRes = ImageManager::imagick()->read($previewPath)->resize(600, 300);
    $previewRes->toWebp()->save("./output/preview_{$i}.webp");

    $playButtonRes = ImageManager::imagick()->read($resizedPlayButtonPath);
    $previewRes->place($playButtonRes, 'center')->toWebp()->save("./output/preview_with_play_{$i}.webp");

    unlink($resizedPlayButtonPath);
}
