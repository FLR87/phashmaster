<?php

include('phash.php');
define('ROOT', dirname(__FILE__));

//$uploaddir = ROOT .'/uploadedimgs/';
$ImgUploaded1 = ROOT . '/uploadedimgs/' . basename($_FILES['img1']['name']);
$ImgUploaded2 = ROOT . '/uploadedimgs/' . basename($_FILES['img2']['name']);
//var_dump($ImgUploaded1);

if (move_uploaded_file($_FILES['img1']['tmp_name'], $ImgUploaded1)
&&
    move_uploaded_file($_FILES['img2']['tmp_name'], $ImgUploaded2))
{
    echo "Files is valid, and was successfully uploaded.</br>";
} else {
    echo "Upload failed.</br>";
}

//echo "<pre>";
//var_dump($_FILES).'</br >';
//echo "</pre>";

$picturePass1= $ImgUploaded1;
$picturePass2= $ImgUploaded2;

//$picturePass1='koala_img/koala1.jpg';
//$picturePass2='koala_img/woman1.jpg';

$imgview1='/uploadedimgs/'.basename($_FILES['img1']['name']);
$imgview2='/uploadedimgs/'.basename($_FILES['img2']['name']);

//sample implementation
$phasher = new Phash;
$phash1 = $phasher->getHash($picturePass1, false);
echo"<p><img src='$imgview1' 
   width='350' height='220' alt='Original img'></p></br >";

echo 'This will echo hash in hex, then binary:'.'</br >';
echo $phasher->hashAsString($phash1, false).PHP_EOL.'</br >';
echo $phasher->hashAsString($phash1).PHP_EOL.'</br >';
echo '============================================================='.'</br >';

$phash2 = $phasher->getHash($picturePass2, false);
echo"<p><img src='$imgview2'  
   width='350' height='220' alt='Compare img'></p></br >";
echo 'This will echo hash in hex, then binary:'.'</br >';
echo $phasher->hashAsString($phash2, false).PHP_EOL.'</br >';
echo $phasher->hashAsString($phash2).PHP_EOL.'</br >';
echo '============================================================='.'</br >';

echo 'BIT COUNT METHOD SIMILARITY:'.'</br >';
echo $phasher->getSimilarity($phash1, $phash2, 'BITS').'</br >';
echo PHP_EOL.'</br >';
echo '============================================================='.'</br >';

echo 'HAMMING METHOD (DEFAULT) SIMILARITY:'.'</br >';
echo $phasher->getSimilarity($phash1, $phash2).'</br >';
echo PHP_EOL.'</br >';

echo '============================================================='.'</br >';
