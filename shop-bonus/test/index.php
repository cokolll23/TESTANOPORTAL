<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("testaaa");

use Lab\Helpers\UsersHelpers;
use Lab\Helpers\IblockHelpers;
use Bitrix\Iblock\Elements\ElementSotrudnikiTable;
use Bitrix\Main\Loader;
use Lab\Helpers\UsersHelpers as UH;

CModule::IncludeModule('sale');
Cmodule::IncludeModule('catalog');
$ORDER = \Bitrix\Sale\Order::load(29);
$res = CSaleBasket::GetList(array(), array("ORDER_ID" => 30)); // ID заказа
$json_product = array();
while ($arItem = $res->Fetch()) {
    $json[] = array(
        'name' => $arItem['NAME'],
        'id' => $arItem['PRODUCT_ID'],
        'price' => $arItem['PRICE'],
        'quantity' => $arItem['QUANTITY']
    );
}
foreach ($json as $item) {
    $basketQuantity = $item['quantity'];
    $quantityNow = CCatalogProduct::GetByID($item['id'])['QUANTITY'];
    $ar_res[] = CCatalogProduct::GetByID($item['id']);
    $quantityNew = $quantityNow + $basketQuantity;
    $arFields = array('QUANTITY' => $quantityNew);// зарезервированное количество
    CCatalogProduct::Update($item['id'], $arFields);
}


pretty_print($ar_res);
?>
<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>