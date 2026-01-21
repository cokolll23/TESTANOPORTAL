<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var CBitrixPersonalOrderListComponent $component */
/** @var array $arParams */

/** @var array $arResult */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/bootstrap_v4/style.css");
CJSCore::Init(array('clipboard', 'fx'));

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL'])) {
    foreach ($arResult['ERRORS']['FATAL'] as $code => $error) {
        if ($code !== $component::E_NOT_AUTHORIZED)
            ShowError($error);
    }
    $component = $this->__component;
    if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED])) {
        ?>
        <div class="row">
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <div class="alert alert-danger"><?= $arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED] ?></div>
            </div>
            <? $authListGetParams = array(); ?>
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                <? $APPLICATION->AuthForm('', false, false, 'N', false); ?>
            </div>
        </div>
        <?
    }

} else {
    $filterHistory = ($_REQUEST['filter_history'] ?? '');
    $filterShowCanceled = ($_REQUEST["show_canceled"] ?? '');

    if (!empty($arResult['ERRORS']['NONFATAL'])) {
        foreach ($arResult['ERRORS']['NONFATAL'] as $error) {
            ShowError($error);
        }
    }
    if (empty($arResult['ORDERS'])) {
        if ($filterHistory === 'Y') {
            if ($filterShowCanceled === 'Y') {
                ?>
                <h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER') ?></h3>
                <?
            } else {
                ?>
                <h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST') ?></h3>
                <?
            }
        } else {
            ?>
            <h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST') ?></h3>
            <?
        }
    }
    ?>
    <div class="container">
    <?
    if (empty($arResult['ORDERS'])) {
        ?>
        <div class="row mb-3">
            <div class="col">
                <a href="<?= htmlspecialcharsbx($arParams['PATH_TO_CATALOG']) ?>"
                   class="mr-4"><?= Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG') ?></a>
            </div>
        </div>
        <?
    }

    if ($filterHistory !== 'Y') {
        $paymentChangeData = array();
        $orderHeaderStatus = null;

        foreach ($arResult['ORDERS'] as $key => $order) {
            if ($orderHeaderStatus !== $order['ORDER']['STATUS_ID'] && $arResult['SORT_TYPE'] == 'STATUS') {
                $orderHeaderStatus = $order['ORDER']['STATUS_ID'];

                ?>
                <div class="row mb-3">
                    <div class="col">
                        <h2><?= Loc::getMessage('SPOL_TPL_ORDER_IN_STATUSES') ?>
                            &laquo;<?= htmlspecialcharsbx($arResult['INFO']['STATUS'][$orderHeaderStatus]['NAME']) ?>&raquo;</h2>
                    </div>
                </div>
                <?
            }
            ?>
            <div class="row mx-0 sale-order-list-title-container">
                <h3 class="col mb-1 mt-1">
                    <?= Loc::getMessage('SPOL_TPL_ORDER') ?>
                    <?= Loc::getMessage('SPOL_TPL_NUMBER_SIGN') . $order['ORDER']['ACCOUNT_NUMBER'] ?>
                    <?= Loc::getMessage('SPOL_TPL_FROM_DATE') ?>
                    <?= $order['ORDER']['DATE_INSERT_FORMATED'] ?>,
                    <?= count($order['BASKET_ITEMS']); ?>
                    <?
                    $count = count($order['BASKET_ITEMS']) % 10;
                    if ($count == '1') {
                        echo Loc::getMessage('SPOL_TPL_GOOD');
                    } elseif ($count >= '2' && $count <= '4') {
                        echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
                    } else {
                        echo Loc::getMessage('SPOL_TPL_GOODS');
                    }
                    ?>
                    <?= Loc::getMessage('SPOL_TPL_SUMOF') ?>
                    <?= $order['ORDER']['FORMATED_PRICE'] ?>
                </h3>
            </div>
            <div class="row mx-0 mb-5">
                <div class="col pt-3 sale-order-list-inner-container">



                    <div class="row mb-3">
                        <div class="col">
                            <hr class="sale-order-list-inner-title-line"/>
                        </div>
                    </div>

                    <div class="row pb-3 sale-order-list-inner-row">
                        <div class="col-auto sale-order-list-about-container">
                            <a class="g-font-size-15 sale-order-list-about-link"
                               href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_DETAIL"]) ?>"><?= Loc::getMessage('SPOL_TPL_MORE_ON_ORDER') ?></a>
                        </div>
                        <div class="col"></div>
                        <div class="col-auto sale-order-list-repeat-container">
                            <a class="g-font-size-15 sale-order-list-repeat-link"
                               href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_COPY"]) ?>"><?= Loc::getMessage('SPOL_TPL_REPEAT_ORDER') ?></a>
                        </div>
                        <?
                        if ($order['ORDER']['CAN_CANCEL'] !== 'N') {
                            ?>
                            <div class="col-auto sale-order-list-cancel-container">
                                <a class="g-font-size-15 sale-order-list-cancel-link"
                                   href="<?= htmlspecialcharsbx($order["ORDER"]["URL_TO_CANCEL"]) ?>"><?= Loc::getMessage('SPOL_TPL_CANCEL_ORDER') ?></a>
                            </div>
                            <?
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?
        }
    }


    echo $arResult["NAV_STRING"];

    if ($filterHistory !== 'Y') {
        $javascriptParams = array(
                "url" => CUtil::JSEscape($this->__component->GetPath() . '/ajax.php'),
                "templateFolder" => CUtil::JSEscape($templateFolder),
                "templateName" => $this->__component->GetTemplateName(),
                "paymentList" => $paymentChangeData,
                "returnUrl" => CUtil::JSEscape($arResult["RETURN_URL"]),
        );
        $javascriptParams = CUtil::PhpToJSObject($javascriptParams);
        ?>
        <script>
            BX.Sale.PersonalOrderComponent.PersonalOrderList.init(<?=$javascriptParams?>);
        </script>
        <?
    }?>
    </div>
<?php }
