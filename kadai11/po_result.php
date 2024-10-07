<?php
// 0. SESSION開始
session_start();
include("funcs.php");
sschk();

// 1. DB接続
$pdo = db_conn();

// 2. SQL作成
$stmt = $pdo->prepare("SELECT * FROM po_survey");
$status = $stmt->execute();

// 3. データ取得
$results = [];
if ($status == false) {
    sql_error($stmt);
} else {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $results[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロダクトオーナーアンケート結果</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>

<h1>アンケート結果</h1>

<!-- 表で結果を表示 -->
<h2>アンケート結果テーブル</h2>
<table>
    <thead>
        <tr>
            <th>進行状況</th>
            <th>コミュニケーション</th>
            <th>バックログの優先順位</th>
            <th>期待される成果の明確さ</th>
            <th>チームパフォーマンス</th>
            <th>問題解決の迅速さ</th>
            <th>製品の品質</th>
            <th>重要な変更の有無</th>
            <th>意思決定の透明性</th>
            <th>改善点</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
            <tr>
                <td><?= $row['po_progress'] ?></td>
                <td><?= $row['team_communication'] ?></td>
                <td><?= $row['backlog_priority'] ?></td>
                <td><?= $row['clear_expectations'] ?></td>
                <td><?= $row['team_performance'] ?></td>
                <td><?= $row['issue_resolution'] ?></td>
                <td><?= $row['product_quality'] ?></td>
                <td><?= $row['major_changes'] ?></td>
                <td><?= $row['decision_process'] ?></td>
                <td><?= htmlspecialchars($row['improvement_points']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- グラフで結果を表示 -->
<h2>アンケート結果グラフ</h2>
<canvas id="poSurveyChart"></canvas>

<script>
    // Chart.jsを使ってグラフを作成
    var ctx = document.getElementById('poSurveyChart').getContext('2d');
    var poSurveyChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                '進行状況', 'コミュニケーション', 'バックログの優先順位', 
                '期待される成果', 'チームパフォーマンス', '問題解決の迅速さ', 
                '製品の品質', '意思決定の透明性'
            ],
            datasets: [{
                label: 'アンケートスコア',
                data: [
                    <?php
                        // 各質問の平均値を計算してグラフに反映
                        function calcAverage($key, $results) {
                            $sum = 0;
                            $count = count($results);
                            foreach ($results as $result) {
                                $sum += $result[$key];
                            }
                            return $sum / $count;
                        }
                        echo calcAverage('po_progress', $results) . ',';
                        echo calcAverage('team_communication', $results) . ',';
                        echo calcAverage('backlog_priority', $results) . ',';
                        echo calcAverage('clear_expectations', $results) . ',';
                        echo calcAverage('team_performance', $results) . ',';
                        echo calcAverage('issue_resolution', $results) . ',';
                        echo calcAverage('product_quality', $results) . ',';
                        echo calcAverage('decision_process', $results);
                    ?>
                ],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5
                }
            }
        }
    });
</script>

</body>
</html>
