<?php
function cropImage($aInitialImageFilePath, $aNewImageFilePath, $aNewImageWidth, $aNewImageHeight) {
if (($aNewImageWidth < 0) || ($aNewImageHeight < 0)) return false;
$lAllowedExtensions = array(1 => "gif", 2 => "jpeg", 3 => "png");
list($lInitialImageWidth, $lInitialImageHeight, $lImageExtensionId) = getimagesize($aInitialImageFilePath);
if (!array_key_exists($lImageExtensionId, $lAllowedExtensions)) return false;
$lImageExtension = $lAllowedExtensions[$lImageExtensionId];
$func = 'imagecreatefrom' . $lImageExtension;
$lInitialImageDescriptor = $func($aInitialImageFilePath);
$lCroppedImageWidth = 0;
$lCroppedImageHeight = 0;
$lInitialImageCroppingX = 0;
$lInitialImageCroppingY = 0;
if ($aNewImageWidth / $aNewImageHeight > $lInitialImageWidth / $lInitialImageHeight) {
$lCroppedImageWidth = floor($lInitialImageWidth);
$lCroppedImageHeight = floor($lInitialImageWidth * $aNewImageHeight / $aNewImageWidth);
$lInitialImageCroppingY = floor(($lInitialImageHeight - $lCroppedImageHeight) / 2);
} else {
$lCroppedImageWidth = floor($lInitialImageHeight * $aNewImageWidth / $aNewImageHeight);
$lCroppedImageHeight = floor($lInitialImageHeight);
$lInitialImageCroppingX = floor(($lInitialImageWidth - $lCroppedImageWidth) / 2);
}

$lNewImageDescriptor = imagecreatetruecolor($aNewImageWidth, $aNewImageHeight);
imagecopyresampled($lNewImageDescriptor, $lInitialImageDescriptor, 0, 0, $lInitialImageCroppingX, $lInitialImageCroppingY, $aNewImageWidth, $aNewImageHeight, $lCroppedImageWidth, $lCroppedImageHeight);
$func = 'image' . $lImageExtension;
return $func($lNewImageDescriptor, $aNewImageFilePath);
}


function deletfile($directory,$filename) {
$dir = opendir($directory);
while(($file = readdir($dir))) {
if((is_file("$directory/$file")) && ("$directory/$file" == "$directory/$filename")) {
unlink("$directory/$file");
if(!file_exists($directory."/".$filename)) return true;
}
}
closedir($dir);
}
?>