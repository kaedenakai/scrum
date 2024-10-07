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
  <title>プロダクトオーナー向けレトロスペクティブアンケート</title>
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
  <h1>プロダクトオーナー向けアンケート</h1>

  <!-- PO用アンケートフォーム -->
  <form method="post" action="insert.php">
    <div class="jumbotron">
      <fieldset>
        <legend>プロダクトオーナーアンケート</legend>

        <!-- 質問1 -->
        <div class="question">
          <label>1. スプリントの進行状況は予定通りでしたか？</label>
          <select name="po_progress" class="form-control">
            <option value="1">1 - 全く予定通りでない</option>
            <option value="2">2 - やや遅れた</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 順調</option>
            <option value="5">5 - 非常に順調</option>
          </select>
        </div>

        <!-- 質問2 -->
        <div class="question">
          <label>2. 開発チームとのコミュニケーションはスムーズに行われましたか？</label>
          <select name="team_communication" class="form-control">
            <option value="1">1 - 全くスムーズでない</option>
            <option value="2">2 - あまりスムーズでない</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - かなりスムーズ</option>
            <option value="5">5 - 非常にスムーズ</option>
          </select>
        </div>

        <!-- 質問3 -->
        <div class="question">
          <label>3. バックログの優先順位は適切に設定されていましたか？</label>
          <select name="backlog_priority" class="form-control">
            <option value="1">1 - 全く適切でない</option>
            <option value="2">2 - やや不適切</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 適切</option>
            <option value="5">5 - 非常に適切</option>
          </select>
        </div>

        <!-- 質問4 -->
        <div class="question">
          <label>4. スプリントで期待される成果は明確でしたか？</label>
          <select name="clear_expectations" class="form-control">
            <option value="1">1 - 全く明確でない</option>
            <option value="2">2 - あまり明確でない</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - かなり明確</option>
            <option value="5">5 - 非常に明確</option>
          </select>
        </div>

        <!-- 質問5 -->
        <div class="question">
          <label>5. チームのパフォーマンスに満足していますか？</label>
          <select name="team_performance" class="form-control">
            <option value="1">1 - 全く満足していない</option>
            <option value="2">2 - やや不満</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 満足</option>
            <option value="5">5 - 非常に満足</option>
          </select>
        </div>

        <!-- 質問6 -->
        <div class="question">
          <label>6. スプリント中に発生した問題は早急に対処されましたか？</label>
          <select name="issue_resolution" class="form-control">
            <option value="1">1 - 全く対処されていない</option>
            <option value="2">2 - やや遅い</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 速い</option>
            <option value="5">5 - 非常に速い</option>
          </select>
        </div>

        <!-- 質問7 -->
        <div class="question">
          <label>7. プロダクトの品質には満足していますか？</label>
          <select name="product_quality" class="form-control">
            <option value="1">1 - 全く満足していない</option>
            <option value="2">2 - やや不満</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 満足</option>
            <option value="5">5 - 非常に満足</option>
          </select>
        </div>

        <!-- 質問8 -->
        <div class="question">
          <label>8. スプリント中に重要な変更が発生しましたか？</label>
          <select name="major_changes" class="form-control">
            <option value="yes">はい</option>
            <option value="no">いいえ</option>
          </select>
        </div>

        <!-- 質問9 -->
        <div class="question">
          <label>9. プロダクトオーナーとして、意思決定のプロセスは透明でしたか？</label>
          <select name="decision_process" class="form-control">
            <option value="1">1 - 全く透明でない</option>
            <option value="2">2 - やや不透明</option>
            <option value="3">3 - 普通</option>
            <option value="4">4 - 透明</option>
            <option value="5">5 - 非常に透明</option>
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
