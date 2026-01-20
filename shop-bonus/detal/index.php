<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Детализация баллов");
?>
<?$APPLICATION->IncludeComponent(
    "lab:news.detail",
    "templateIM",
    Array(
        "ACTIVE_DATE_FORMAT" => "d.m.Y",
        "ADD_ELEMENT_CHAIN" => "N",
        "ADD_SECTIONS_CHAIN" => "Y",
        "AJAX_MODE" => "N",
        "AJAX_OPTION_ADDITIONAL" => "",
        "AJAX_OPTION_HISTORY" => "N",
        "AJAX_OPTION_JUMP" => "N",
        "AJAX_OPTION_STYLE" => "Y",
        "BROWSER_TITLE" => "-",
        "CACHE_GROUPS" => "N",
        "CACHE_TIME" => "36000",
        "CACHE_TYPE" => "A",
        "CHECK_DATES" => "Y",
        "COMPONENT_TEMPLATE" => "templateIM",
        "DETAIL_URL" => "",
        "DISPLAY_BOTTOM_PAGER" => "Y",
        "DISPLAY_DATE" => "Y",
        "DISPLAY_NAME" => "Y",
        "DISPLAY_PICTURE" => "Y",
        "DISPLAY_PREVIEW_TEXT" => "Y",
        "DISPLAY_TOP_PAGER" => "N",
        "ELEMENT_CODE" => "",
        "ELEMENT_ID" => $_REQUEST["ELEMENT_ID"],
        "FIELD_CODE" => array(0=>"",1=>"",),
        "IBLOCK_ID" => "44",
        "IBLOCK_TYPE" => "users",
        "IBLOCK_URL" => "",
        "INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
        "MESSAGE_404" => "",
        "META_DESCRIPTION" => "-",
        "META_KEYWORDS" => "-",
        "PAGER_BASE_LINK_ENABLE" => "N",
        "PAGER_SHOW_ALL" => "N",
        "PAGER_TEMPLATE" => ".default",
        "PAGER_TITLE" => "Страница",
        "PROPERTY_CODE" => array(0=>"COLUMN2",1=>"COLUMN3",2=>"COLUMN4",3=>"COLUMN5",4=>"COLUMN6",5=>"COLUMN7",6=>"COLUMN8",7=>"COLUMN9",8=>"COLUMN10",9=>"COLUMN11",10=>"COLUMN12",11=>"COLUMN13",12=>"COLUMN14",13=>"COLUMN15",14=>"COLUMN16",15=>"COLUMN17",16=>"COLUMN18",17=>"COLUMN19",18=>"COLUMN20",19=>"COLUMN21",20=>"COLUMN22",21=>"COLUMN23",22=>"COLUMN24",23=>"COLUMN25",24=>"COLUMN26",25=>"COLUMN27",26=>"COLUMN28",27=>"COLUMN29",28=>"COLUMN30",29=>"COLUMN31",30=>"COLUMN32",31=>"COLUMN33",32=>"",),
        "SET_BROWSER_TITLE" => "Y",
        "SET_CANONICAL_URL" => "N",
        "SET_LAST_MODIFIED" => "N",
        "SET_META_DESCRIPTION" => "N",
        "SET_META_KEYWORDS" => "Y",
        "SET_STATUS_404" => "N",
        "SET_TITLE" => "N",
        "SHOW_404" => "N",
        "STRICT_SECTION_CHECK" => "N",
        "USE_PERMISSIONS" => "N",
        "USE_SHARE" => "N"
    )
);?>



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>