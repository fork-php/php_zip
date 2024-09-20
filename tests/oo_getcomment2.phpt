--TEST--
getComment
--SKIPIF--
<?php
if(!extension_loaded('zip')) die('skip');
if (PHP_VERSION_ID < 80000) die('skip PHP 8 only');
?>
--FILE--
<?php
$dirname = __DIR__ . '/';
$file = $dirname . 'test_with_comment.zip';
include $dirname . 'utils.inc';
$zip = new ZipArchive;
if (!$zip->open($file)) {
    exit('failed');
}
echo $zip->getArchiveComment() . "\n";

$idx = $zip->locateName('foo');
var_dump($zip->getCommentName('foo'));
var_dump($zip->getCommentIndex($idx));

try {
    echo $zip->getCommentName('') . "\n";
} catch (\ValueError $e) {
    echo $e->getMessage() . \PHP_EOL;
}

$zip->close();

?>
--EXPECTF--
Zip archive comment
string(11) "foo comment"
string(11) "foo comment"
ZipArchive::getCommentName(): Argument #1 ($name) %s be empty
