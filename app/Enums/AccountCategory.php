<?php

namespace App\Enums;

// DBに保存する際の型を指定する
enum AccountCategory: string
{
    // ここで定数を列挙する
    // caseは文法上必要なだけ
    case Asset = 'asset';
    case Liability = 'liability';

    // このメソッドで値を返してあげる
    public function label(): string
    {
        // $thisはそのときのオブジェクト自身を指す
        // AccountCategory::Asset->label()を呼んだときは
        // $thisはAccountCategory::Assetとなる
        return match($this) {
            // selfはenumクラス自身を指す
            // 自分のクラスの中にある定数を参照するときに使う
            self::Asset => '資産',
            self::Liability =>'負債',
        };
    }
}
