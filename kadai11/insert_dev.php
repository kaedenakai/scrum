<?php
// 0. SESSION開始
session_start();

// LOGINチェック → funcs.phpへ関数化
include("funcs.php");
sschk();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>開発者向けレトロスペクティブアンケート</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <style>
    div { padding: 10px; font-size: 16px; }
    .container { max-width: 600px; margin: 0 auto; }
    .question { margin-bottom: 15px; }
    .question label { display: block; }
  </style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">ホームへ戻る</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="container">
  <h1>開発者向けアンケート</h1>

  <!-- 開発者用アンケートフォーム -->
  <form method="post" action="insert.php">
    <div class="jumbotron">
      <fieldset>
        <legend>開発者アンケート</legend>

        <!-- 質問1 -->
        <div class="question">
          <label>1. スプリントの目標は明確でしたか？</label>
          <select name="sprint_goal_clarity" class="form-control">
            <option value="1">1 - 全く明確でない</option>
            <option value="2">2 - やや不明確</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 明確</option>
            <option value="5">5 - 非常に明確</option>
          </select>
        </div>

        <!-- 質問2 -->
        <div class="question">
          <label>2. チーム内の協力はスムーズでしたか？</label>
          <select name="team_cooperation" class="form-control">
            <option value="1">1 - 全くスムーズでない</option>
            <option value="2">2 - ややスムーズでない</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - スムーズ</option>
            <option value="5">5 - 非常にスムーズ</option>
          </select>
        </div>

        <!-- 質問3 -->
        <div class="question">
          <label>3. スプリント中の作業負荷は適切でしたか？</label>
          <select name="workload" class="form-control">
            <option value="1">1 - 全く適切でない</option>
            <option value="2">2 - やや過負荷</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 適切</option>
            <option value="5">5 - 非常に適切</option>
          </select>
        </div>

        <!-- 質問4 -->
        <div class="question">
          <label>4. スプリントバックログの項目は適切に選定されていましたか？</label>
          <select name="backlog_items" class="form-control">
            <option value="1">1 - 全く適切でない</option>
            <option value="2">2 - やや不適切</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 適切</option>
            <option value="5">5 - 非常に適切</option>
          </select>
        </div>

        <!-- 質問5 -->
        <div class="question">
          <label>5. スプリントの振り返りは有意義でしたか？</label>
          <select name="retrospective_value" class="form-control">
            <option value="1">1 - 全く有意義でない</option>
            <option value="2">2 - あまり有意義でない</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 有意義</option>
            <option value="5">5 - 非常に有意義</option>
          </select>
        </div>

        <!-- 質問6 -->
        <div class="question">
          <label>6. 開発チーム内で問題が発生した際、迅速に対応されましたか？</label>
          <select name="problem_resolution" class="form-control">
            <option value="1">1 - 全く対応されなかった</option>
            <option value="2">2 - 対応が遅かった</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 速かった</option>
            <option value="5">5 - 非常に速かった</option>
          </select>
        </div>

        <!-- 質問7 -->
        <div class="question">
          <label>7. プロダクトオーナーとのやりとりはスムーズでしたか？</label>
          <select name="po_interaction" class="form-control">
            <option value="1">1 - 全くスムーズでない</option>
            <option value="2">2 - ややスムーズでない</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - スムーズ</option>
            <option value="5">5 - 非常にスムーズ</option>
          </select>
        </div>

        <!-- 質問8 -->
        <div class="question">
          <label>8. スプリントにおける技術的な問題はスムーズに解決されましたか？</label>
          <select name="technical_issues" class="form-control">
            <option value="1">1 - 全く解決されなかった</option>
            <option value="2">2 - 解決が遅かった</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 速く解決された</option>
            <option value="5">5 - 非常に速く解決された</option>
          </select>
        </div>

        <!-- 質問9 -->
        <div class="question">
          <label>9. チーム全体のスキル向上はありましたか？</label>
          <select name="skill_improvement" class="form-control">
            <option value="1">1 - 全くなかった</option>
            <option value="2">2 - あまりなかった</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - かなりあった</option>
            <option value="5">5 - 非常にあった</option>
          </select>
        </div>

        <!-- 質問10 -->
        <div class="question">
          <label>10. スプリントを通じて改善すべき点はありますか？</label>
          <textarea name="improvement_points" rows="4" class="form-control"></textarea>
        </div>

        <input type="submit" value="送信" class="btn btn-primary">
      </fieldset>
    </div>
  </form>
</div>
<!-- Main[End] -->

</body>
</html>
