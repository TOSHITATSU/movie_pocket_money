<?php
function calculateRentals($remainingAmount) {
  $rentalOptions = [
    'TSUTAYA' => [
      '定額レンタル4: /1026円' => ['price' => 1026, 'max_count' => 4],
      '定額レンタル8: /2052円' => ['price' => 2052, 'max_count' => 8],
      '単品料金DVD/ブルーレイ: 242円' => ['price' => 242, 'max_count' => null]
    ],
    'GEO' => [
      'スタンダード4: /990円' => ['price' => 990, 'max_count' => 4],
      'スタンダード8: /2046円' => ['price' => 2046, 'max_count' => 8],
      'ダブル16: /4136円' => ['price' => 4136, 'max_count' => 16],
      '単品料金旧作: /105円' => ['price' => 105, 'max_count' => null],
      '準新作: /253円' => ['price' => 253, 'max_count' => null],
      '新作: /396円' => ['price' => 396, 'max_count' => null]
    ],
    'Amazonプライムビデオ' => [
      '単品どれでも: /199円' => ['price' => 199, 'max_count' => null]
    ]
  ];

  $result = [];
  foreach ($rentalOptions as $provider => $options) {
    $providerResult = [];
    foreach ($options as $plan => $data) {
      $price = $data['price'];
      $max_count = $data['max_count'];

      if ($max_count !== null) {
        // 定額プランの場合
        if ($remainingAmount >= $price) {
          $providerResult[$plan] = $max_count;
        } else {
          $providerResult[$plan] = "残額不足";
        }
      } else {
        // 単品プランの場合
        $count = floor($remainingAmount / $price);
        $providerResult[$plan] = $count > 0 ? $count : "残額不足";
      }
    }
    $result[$provider] = $providerResult;
  }
  return $result;
}

// この関数は、残高を元に、レンタル業者ごとに表示できるプランを計算するものです。

// まず、レンタル業者とプランを含む連想配列 $rentalOptions を定義します。この配列には、それぞれのプランの値段、最大で借りられる本数などの情報が含まれています。

// 関数内で、各レンタル業者のプランごとに、そのプランを選ぶことができるかどうかを判断します。定額プランの場合、残高が十分であれば最大借りられる本数を、不十分であれば「残高不足」というメッセージを返します。単品プランの場合、残高から借りられる本数を計算し、0よりも多ければその本数を、0以下であれば「残高不足」というメッセージを返します。

// 計算結果は、レンタル業者ごとに、プラン名をキーとして、借りられる本数またはエラーメッセージを含む連想配列 $result に格納され、最終的に関数から返されます。
?>
