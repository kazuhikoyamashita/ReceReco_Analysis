<?php
require_once 'Igo.php'; // 事前にIgoライブラリをインストールする必要があります。

// ReceRecoのCSVデータをロードする
$data = explode("\n", file_get_contents("")); // ReceRecoから出力したCSVファイルを指定してください。

$igo = new Igo("./ipadic", "UTF-8"); // ipadicのパスを指定する必要があります。

$items = array();
for ($i = 0; $i < count($data); $i++) {
    $text = $data[$i];
    $tmp = explode(",", $text);
    $item = $tmp[9]; // 品目を取得
    $result = $igo->parse($item);

    foreach ($result as $value) {
	    $items[] = $value->surface;
    }
}

// 品目の出現頻度をカウント
$item_count = array_count_values($items);
asort($item_count);

// 品目名と出現頻度を出力
foreach ($item_count as $key => $value) {
    echo $key . "," . $value . "\n";
}
