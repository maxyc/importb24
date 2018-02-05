#!/user/bin/php -q
<?php

require 'vendor/autoload.php';
require 'b24import/base.php';
require 'b24import/product.php';


$key = 'dlizeyw8pw7wrz9f';
$url = 'http://maxyc.bx/rest/1/'.$key.'/';
$fieldId = 98;


$fileName = 'endomedium_2018.xls';
$pathToFile = __DIR__.'/';

echo '<pre>';
$productImport = new \B24Import\Product($url, $fieldId);
$productImport->importFromFile($pathToFile.$fileName);
print_r($productImport->getResult());
echo '</pre>';
/*


$i=0;

$curl = new Curl();

foreach($sheetData as $rowNum=>$columns)
{
	

	$curl->get($url.'crm.product.list/', array(
		'SELECT'=>array('ID', 'NAME', 'PRICE', 'PROPERTY_*'), 
		'FILTER'=>array('PROPERTY_'.$fieldId=>$columns['A']))
	);

	if ($curl->error) {
	    errorProduct($columns, $curl);
	} else {
	    $result = $curl->response;

	    if($result->total == 0)
	    {
	    	createProduct($columns);
	    }
	    else
	    {
	    	$current = $result->result[0];
			updateProduct($current->ID, $columns);
	    }
	    
	}
}

echo '</pre>';

function errorProduct($columns, $curl)
{
	echo 'Error: ' . $curl->errorCode . ': ' . $curl->errorMessage . "\n";
	echo "error product '{$columns['B']}, price: {$columns['C']}, category: {$columns['A']}\n";
}

function createProduct($columns)
{
	global $curl, $url, $fieldId;

	echo "create product '{$columns['B']}, price: {$columns['C']}, category: {$columns['A']}\n";

	$result = $curl->get($url.'crm.product.add/', array(
		'FIELDS'=>array(
			'NAME'=>$columns['B'],
			'PRICE'=>$columns['C'],
			'PROPERTY_'.$fieldId=>$columns['A']
			
		)
	));

	
	echo "<strong>Done... #$result->result</strong>\n\n";
}

function updateProduct($id, $columns)
{
	global $curl, $url, $fieldId;

	echo "update product '{$columns['B']}, price: {$columns['C']}, category: {$columns['A']}\n";

	$result = $curl->get($url.'crm.product.update/', array(
		'ID'=>$id,
		'FIELDS'=>array(
			'NAME'=>$columns['B'],
			'PRICE'=>$columns['C'],
			'PROPERTY_'.$fieldId=>$columns['A']
			
		)
	));

	if ($result->result)
	{
		echo "<strong>Done</strong>\n\n";
	}
	else 
	{
		echo "<strong>Error!</strong>\n\n";
	}
}
*/
?>