<?php
/**
 * Maxyc Webber
 * maxycws@gmail.com
 */

namespace B24Import;

use PhpOffice\PhpSpreadsheet\IOFactory;

class Product extends Base
{
	private $fieldId;
	private $fieldId;

	public function __construct($url, $fieldId)
	{
		$this->setUrl($url);
		$this->setFieldId($fieldId);

		parent::__construct();
	}

	public function importFromFile($filePath)
	{
		$data = $this->getDataFromSource($filePath);

		foreach ($data as $row)
		{
			$product = $this->getProducts(array('PROPERTY_'.$this->getFieldId() => $row['A']));

			if ($product->total)
			{
				foreach($product->result as $item)
				{
					$result = $this->update($item->ID, $row);
					$this->setResult($result->result ? 'UPDATE' : 'ERROR', array(array_merge(array('ID'=>$item->ID, $row))));
				}
			}
			else
			{
				$result = $this->create($row);
				$this->setResult($result->result ? 'CREATE' : 'ERROR', array($row));
			}
		}
	}

	private function getDataFromSource($filePath)
	{
		$spreadsheet = IOFactory::load($filePath);
		$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

		return $this->formatData($sheetData);
	}

	private function formatData($data)
	{
		$out = array();
		foreach ($data as $rowNumber => $columns)
		{
			$columns = array_filter($columns);
			if (array_key_exists('C', $columns) && preg_match('#\d+,\d+#', $columns['C']))
			{
				$columns['C'] = str_replace(',', '.', $columns['C']);
				$out[] = $columns;
			}
		}

		return $out;
	}

	private function getProducts(array $filter)
	{
		$result = $this->query(
			'crm.product.list',
			array(
				'SELECT' => array('ID', 'NAME', 'PRICE', 'PROPERTY_*'),
				'FILTER' => $filter
			)
		);

		return $result;
	}

	/**
	 * @return mixed
	 */
	public function getFieldId()
	{
		return $this->fieldId;
	}

	/**
	 * @param mixed $fieldId
	 */
	public function setFieldId($fieldId)
	{
		$this->fieldId = $fieldId;
	}

	function update($id, $columns)
	{
		$result = $this->query(
			'crm.product.update',
			array(
				'ID' => $id,
				'FIELDS' => array(
					'NAME' => $columns['B'],
					'PRICE' => $columns['C'],
					'PROPERTY_'.$this->getFieldId() => $columns['A']
				)
			)
		);

		return $result;
	}

	private function create($columns)
	{
		$result = $this->query(
			'crm.product.add',
			array(
				'FIELDS' => array(
					'NAME' => $columns['B'],
					'PRICE' => $columns['C'],
					'PROPERTY_'.$this->getFieldId() => $columns['A']
				)
			)
		);

		return $result;
	}
}