<?php
require 'vendor/autoload.php';
require 'b24import/base.php';
require 'b24import/product.php';

if(!$_POST)
{
	return;
}

$dateTime = new DateTime();
$logDir = 'log/'.$dateTime->format('d.m.Y H:i').'/';
@chmod($logDir, 0777);
@mkdir($logDir, 0777, true);

$url = $_POST['url'];
$fieldId = $_POST['fieldId'];
$currencyId = $_POST['currencyId'];
$pathToFile = $logDir.$_FILES['file']['name'];

move_uploaded_file($_FILES['file']['tmp_name'], $pathToFile);

$productImport = new \B24Import\Product($url, $fieldId, $currencyId);
$productImport->importFromFile($pathToFile);
$result = $productImport->getResult();

$created = $updated = $errors = 0;

echo "Done!\n";

if(array_key_exists('CREATE', $result))
{
	file_put_contents($logDir.'created.txt', var_export($result['CREATE'], true));
	$created = count($result['CREATE']);
	echo "<strong>Created</strong>: <a href=\"{$logDir}created.txt\">{$created}</a>; ";
}
if(array_key_exists('UPDATE', $result))
{
	file_put_contents($logDir.'update.txt', var_export($result['UPDATE'], true));
	$updated = count($result['UPDATE']);
	echo "<strong>Updated</strong>: <a href=\"{$logDir}update.txt\">{$updated}</a>; ";
}

if(array_key_exists('ERROR', $result))
{
	file_put_contents($logDir.'error.txt', var_export($result['ERROR'], true));
	$errors = count($result['ERROR']);
	echo "<strong>Errors</strong>: <a href=\"{$logDir}error.txt\">{$errors}</a>;";
}

echo '<a href="/"><< Back <<</a>';



?>