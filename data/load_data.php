<?php
$db = new PDO('sqlite:' .realpath(__DIR__) . '/blog.db');
$fh = fopen(__DIR__. '/schema.sql', 'r');
while ($line = fread($fh, 4096)) {
	$db->exec($line) or die(print_r($db->errorInfo(), true));
}
fclose($fh);