<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}
use Lab\Helpers\SaleHelpers as SaleHelpers;
$arResQntt= SaleHelpers::getCurrentUserRealQuantityBasketProduct();

$arResult['TOTAL_QUANTITY'] = $arResQntt['TOTAL_QUANTITY'];



