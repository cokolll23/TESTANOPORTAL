<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

//pretty_print($arResult);
//pretty_print($arPropsNew);

?>
<div class="news-detail">
    <? if ((!isset($arParams["DISPLAY_NAME"]) || $arParams["DISPLAY_NAME"] != "N") && $arResult["NAME"]): ?>
        <h3><?= $arResult["NAME"] ?></h3>
    <? endif; ?>
    <div style="clear:both"></div>
    <br/>
    <?
    foreach ($arResult["DISPLAY_PROPERTIES"] as $pid => $arProperty):?>
        <? if ($pid != 'COLUMN33' && $pid != 'COLUMN34'): ?>
            <?
            $arPropsNew[] = $arProperty;
            ?>
        <? endif; ?>
    <?endforeach;
    foreach ($arPropsNew as $arProperty) {
        ?>
        <div>
        <span>
            <?= $arProperty["NAME"] ?>:&nbsp;
            <?= $arProperty["DISPLAY_VALUE"]; ?>
               </span>
        </div>
    <?php } ?>
    <br>
    <div class="item i-<?= $pid ?>">
           <span style="font-weight: bold; font-size: 120%"> <?= $arResult["DISPLAY_PROPERTIES"]['COLUMN33']["NAME"] ?> доступно :&nbsp;
            <?= $arResult["DISPLAY_PROPERTIES"]['COLUMN33']['DISPLAY_VALUE']; ?> М-баллов.
               </span>
    </div>


    <? if (\Lab\Helpers\SaleHelpers::getCurrentUserPriceOrders() > 0) {
        $ordersPrice = \Lab\Helpers\SaleHelpers::getCurrentUserPriceOrders();
    } else {
        $ordersPrice = 0;
    }
    ?>
    <b style="font-size: 19px">Израсходовано: <?= $ordersPrice; ?>
        М-баллов.</b>
</div>