<!doctype html>
<html lang="en">
<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

	<title>B24 Import</title>
</head>
<body>
<?php
$config = (array)(file_exists('config.json')
	? json_decode(file_get_contents('config.json'))
	: array(
		'url' => '',
		'fieldId' => 99
	));
?>
<div class="container">
	<h1>B24 Import</h1>

	<div class="row">
		<div class="col-sm-6">
			<h3>Импорт товаров</h3>

			<form class="form-horizontal" action="product.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="url" class="col-sm-2 control-label">Url: *</label>
					<div class="col-sm-10">
						<input name="url" type="url" class="form-control" id="url" value="<?=$config['url']?>" placeholder="https://maxyc.bitrix24.ru/rest/1/jb9gdftnp25x84yh/">
						<span class="help-block">Левое меню - Приложения - Вебхуки - Создать входящий вебхук - CRM - Сохранить</span>
					</div>
				</div>
				<div class="form-group">
					<label for="fieldId" class="col-sm-2 control-label">FieldId: *</label>
					<div class="col-sm-10">
						<input name="fieldId" type="number" class="form-control" id="fieldId" value="<?=$config['fieldId']?>" placeholder="99">
						<span class="help-block">ID свойства товара №кат</span>
					</div>
				</div>
				<div class="form-group">
					<label for="file" class="col-sm-2 control-label">File: *</label>
					<div class="col-sm-10">
						<input name="file" type="file" class="form-control" id="file">
						<span class="help-block">Форматы MS Excel (1999-2017): XLS, XLSX</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default">Импортировать</button>
					</div>
				</div>
			</form>

		</div>
		<div class="col-sm-6">
			<h3>Импорт счетов</h3>

			<form class="form-horizontal" action="orders.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label for="url" class="col-sm-2 control-label">Url: *</label>
					<div class="col-sm-10">
						<input name="url" type="url" class="form-control" id="url" value="<?=$config['url']?>" placeholder="https://maxyc.bitrix24.ru/rest/1/jb9gdftnp25x84yh/">
						<span class="help-block">Левое меню - Приложения - Вебхуки - Создать входящий вебхук - CRM - Сохранить</span>
					</div>
				</div>

				<div class="form-group">
					<label for="file" class="col-sm-2 control-label">File: *</label>
					<div class="col-sm-10">
						<input name="file" type="file" class="form-control" id="file">
						<span class="help-block">Форматы MS Excel (1999-2017): XLS, XLSX</span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-2 col-sm-10">
						<button type="submit" class="btn btn-default" disabled="disabled">Импортировать</button>
					</div>
				</div>
			</form>

		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Import product for developers</div>
			<div class="panel-body">

				Install:
				<pre>
					1. composer install
					2. chmod 0775 log/
					3. enjoy!
				</pre>

				Usage:
				<pre>
					&lt;?php
					require 'vendor/autoload.php';
					require 'b24import/base.php';
					require 'b24import/product.php';

					$productImport = new \B24Import\Product($url, $fieldId);
					$productImport->importFromFile($pathToFile);
					$result = $productImport->getResult();

					// $result = array('UPDATE'=>array(...), 'ERROR'=>array(...), 'CREATE'=>array(...))
					?&gt;
				</pre>
			</div>
		</div>


	</div>
</div>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>