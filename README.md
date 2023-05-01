「PHP」と「MAMP」を使った「アプリケーション」を実装したい思っています。処理の流れ、参照ドキュメント、条件等について遵守し、詳細のプログラムを出力してください。

＃実装の流れ
delete_subscription.phpの機能を実装

#条件
どのディレクトリやファイルにコード追加するのか、あるいは新たなディレクトリやファイルを作成するのかは推奨される方法にしてください。  
しかし元のディレクトリ設計を削除するのは禁止です。
レンタルのラインナップは以下に通り従ってください
「TSUTAYA DISCAS　定額レンタル4：1026円（税込）定額レンタル：2052円（税込）単品料金DVD/ブルーレイ：242円（税込）」
「 GEO　スタンダード4：990円（税込）スタンダード8：2046円（税込）ダブル16：4136円（税込）単品料金旧作：105円（税込）準新作：253円（税込）新作：396円（税込）」
「 Amazonプライムビデオ　単品どれでも：199円（税込）」
機能実装の際は前の質問の答えで実装されたプログラム実装の流れに従ってください
データベース接続はPDOを採用。
プリペアドステートメントとバインド必須
バリデーションの入力判定と正規表現必須
会員の方のログインへの案内リンクとその逆は必須
データベース設計には従ってください
データベース名: movie_pocket_money
「usersテーブル
id: INT, AUTO_INCREMENT, PRIMARY KEY
name: VARCHAR(255), NOT NULL
email: VARCHAR(255), NOT NULL, UNIQUE
password: VARCHAR(255), NOT NULL
pocket_money: DECIMAL(10,2), DEFAULT 0.00, NOT NULL
created_at: TIMESTAMP, NOT NULL
updated_at: TIMESTAMP, NOT NULL」

「subscriptionsテーブル
id: INT, AUTO_INCREMENT, PRIMARY KEY
user_id: INT, FOREIGN KEY, NOT NULL
name: VARCHAR(255), NOT NULL
amount: DECIMAL(10,2), NOT NULL
created_at: TIMESTAMP, NOT NULL
updated_at: TIMESTAMP, NOT NULL」

下記のディレクトリとファイル管理設計には従ってください
「public/ - 各ページのPHPファイルが配置されます。フォームの表示や処理を行います。
css/ - スタイルシートファイル
js/ - JavaScriptファイル
register.php - ユーザー登録ページ
login.php - ログインページ
subscriptions.php - サブスクリプション一覧ページ
add_subscription.php - サブスクリプション追加ページ
pocket_money.php - お小遣い情報ページ
edit_pocket_money.php - お小遣い編集ページ
index.php - ホームページ」

「includes/ - データベース接続や各種処理を行う関数が定義されたPHPファイルが配置されます。
database.php - データベース接続設定
auth-functions.php - 認証関連の処理を行う関数
subscription-functions.php - サブスクリプション関連の処理を行う関数
pocket_money-functions.php - お小遣い関連の処理を行う関数」

「config/ - 設定ファイルが配置されます。
database.php - データベース接続情報」

＃処理

【フローチャート】

ユーザー登録・ログイン
サブスクリプションサービスの選択・金額入力
お小遣いの設定
サブスクリプション料金の差し引き
残金からレンタル可能な映画本数の自動表示
【ディレクトリとファイルの管理設計】

movie-pocket-money-manager/
    ├── public/
    │   ├── css/
    │   ├── js/
    │   ├── register.php
    │   ├── login.php
    │   ├── subscriptions.php
    │   ├── add_subscription.php
    │   ├── pocket_money.php
    │   ├── edit_pocket_money.php
    │   └── index.php
    ├── includes/
    │   ├── database.php
    │   ├── auth-functions.php
    │   ├── subscription-functions.php
    │   └── pocket_money-functions.php
    └── config/
        └── database.php



【データベースの詳細設計】

データベース名: movie_pocket_money

usersテーブル
id: INT, AUTO_INCREMENT, PRIMARY KEY
name: VARCHAR(255), NOT NULL
email: VARCHAR(255), NOT NULL, UNIQUE
password: VARCHAR(255), NOT NULL
pocket_money: DECIMAL(10,2), DEFAULT 0.00, NOT NULL
created_at: TIMESTAMP, NOT NULL
updated_at: TIMESTAMP, NOT NULL

subscriptionsテーブル
id: INT, AUTO_INCREMENT, PRIMARY KEY
user_id: INT, FOREIGN KEY, NOT NULL
name: VARCHAR(255), NOT NULL
amount: DECIMAL(10,2), NOT NULL
created_at: TIMESTAMP, NOT NULL
updated_at: TIMESTAMP, NOT NULL

上記の設計をもとに、PHPとMAMPを使ってお小遣い管理アプリケーションを実装していくことができます。データベースにはMySQLを使用し、MVCアーキテクチャを採用することで、コードの構成が整理され、保守性が高まります。