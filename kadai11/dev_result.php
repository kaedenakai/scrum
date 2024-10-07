<?php
// 0. SESSION開始
session_start();

// LOGINチェック → funcs.phpへ関数化
include("funcs.php");
sschk();
$pdo = db_conn(); // Assuming db_conn() function exists for DB connection

// データ取得
$stmt = $pdo->prepare("SELECT * FROM po_survey");
$status = $stmt->execute();

// データの表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>アンケート結果</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    table {
        width: 100%;
        border-collapse: collapse;
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

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">ホームへ戻る</a>
      </div>
    </div>
  </nav>
</header>

<!-- Table to display raw data -->
<h2>アンケート結果</h2>
<table>
  <tr>
    <th>ID</th>
    <th>スプリント目標の明確さ</th>
    <th>チーム内の協力</th>
    <th>作業負荷</th>
    <th>スプリントバックログ</th>
    <th>振り返りの有意義さ</th>
    <th>問題解決</th>
    <th>POとのやり取り</th>
    <th>技術的な問題解決</th>
    <th>スキル向上</th>
    <th>改善点</th>
  </tr>

<?php
foreach ($results as $row) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['sprint_goal_clarity'] . "</td>";
    echo "<td>" . $row['team_cooperation'] . "</td>";
    echo "<td>" . $row['workload'] . "</td>";
    echo "<td>" . $row['backlog_items'] . "</td>";
    echo "<td>" . $row['retrospective_value'] . "</td>";
    echo "<td>" . $row['problem_resolution'] . "</td>";
    echo "<td>" . $row['po_interaction'] . "</td>";
    echo "<td>" . $row['technical_issues'] . "</td>";
    echo "<td>" . $row['skill_improvement'] . "</td>";
    echo "<td>" . htmlspecialchars($row['improvement_points']) . "</td>";
    echo "</tr>";
}
?>
</table>

<!-- Graph for survey analysis -->
<h2>アンケート結果のグラフ</h2>
<canvas id="surveyChart"></canvas>

<script>
    // Prepare data for the chart
    const ctx = document.getElementById('surveyChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar', // You can use 'bar', 'pie', 'line', etc.
        data: {
            labels: [
                'スプリント目標の明確さ', 
                'チーム内の協力', 
                '作業負荷', 
                'スプリントバックログ', 
                '振り返りの有意義さ', 
                '問題解決', 
                'POとのやり取り', 
                '技術的な問題解決', 
                'スキル向上'
            ],
            datasets: [{
                label: '平均スコア',
                data: [
                    <?php
                    // Calculate average for each question
                    $avg_data = [
                        array_sum(array_column($results, 'sprint_goal_clarity')) / count($results),
                        array_sum(array_column($results, 'team_cooperation')) / count($results),
                        array_sum(array_column($results, 'workload')) / count($results),
                        array_sum(array_column($results, 'backlog_items')) / count($results),
                        array_sum(array_column($results, 'retrospective_value')) / count($results),
                        array_sum(array_column($results, 'problem_resolution')) / count($results),
                        array_sum(array_column($results, 'po_interaction')) / count($results),
                        array_sum(array_column($results, 'technical_issues')) / count($results),
                        array_sum(array_column($results, 'skill_improvement')) / count($results)
                    ];
                    echo implode(", ", $avg_data);
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
