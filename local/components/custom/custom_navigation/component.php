<?
\Bitrix\Main\Loader::includeModule("iblock");

$nav = new \Bitrix\Main\UI\PageNavigation("residents");
$nav->allowAllRecords(true)
    ->setPageSize((int)$arParams["PAGE_SIZE"])
    ->initFromUri();

$residentsIblock = \Bitrix\Iblock\Iblock::wakeUp((int)$arParams["IBLOCK"])->getEntityDataClass();

$filter = ["=IBLOCK_ID"=>$arParams["IBLOCK"]];

$elements = $residentsIblock::getList([
    "select" => ["ID", "NAME", "FIO_"=>"FIO", "HOUSE_"=>"HOUSE"],
    "filter" => $filter,
    "count_total" => true,
    "offset" => $nav->getOffset(),
    "limit" => $nav->getLimit(),
]);

$residents = [];

while ($element = $elements->fetch()) {
    $houseProperties = CIBlockElement::GetById($element["HOUSE_IBLOCK_GENERIC_VALUE"]);

    $houseProperties = $houseProperties->GetNextElement()->GetProperties();

    foreach($houseProperties as $key => $property){
        $element["HOUSE_PROPS"][$key] = $property["VALUE"];
    }

    $residents[] = $element;
}

$nav->setRecordCount($elements->getCount());
$arResult["NAV_RESULT"] = $nav;
$arResult["RESIDENTS"] = $residents;

$this->IncludeComponentTemplate();
?>