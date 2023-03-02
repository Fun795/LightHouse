<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Loader;

Loc::loadMessages(__FILE__);
Loader::includeModule("iblock");

$iblocks = CIBlock::GetList(

    array(
        "SORT" => "ASC"
    ),
    array(
        "ACTIVE" => "Y"
    )
);

$iblockValues = array();

while($iblock = $iblocks->Fetch()){

    $iBlockValues[$iblock["ID"]] = "[".$iblock["ID"]."] ".$iblock["NAME"];
}
$arComponentParameters = array(
    "PARAMETERS" => array(
        "IBLOCK" => array(
            "NAME" => "Инфоблок",
            "TYPE" => "LIST",
            "VALUES" => $iblockValues
        ),
        "PAGE_SIZE" => array(
            "NAME" => "Количество элементов на странице",
            "TYPE" => "LIST",
            "VALUES" => [5 => "5",10 => "10",15 => "15",25 => "25",50 => "50",100 => "100"],
        ),
        "AJAX_MODE" => array(),
        "SEF_MODE" => array()
    )
);
?>