<?php
/**
 * Seeds the database from database/tourism_db.sql on container start
 * when the schema is missing. Safe to run repeatedly.
 */
$host = getenv("DB_HOST") ?: "localhost";
$user = getenv("DB_USER") ?: "root";
$pass = getenv("DB_PASS") ?: "";
$name = getenv("DB_NAME") ?: "tourism_db";

mysqli_report(MYSQLI_REPORT_OFF);
$conn = null;
for ($i = 0; $i < 30; $i++) {
    $conn = @new mysqli($host, $user, $pass);
    if (!$conn->connect_errno) break;
    fwrite(STDERR, "[seed] waiting for MySQL at $host ({$conn->connect_error})\n");
    sleep(2);
}
if (!$conn || $conn->connect_errno) {
    fwrite(STDERR, "[seed] could not reach MySQL, skipping seed\n");
    exit(0);
}

$exists = $conn->query("SELECT 1 FROM information_schema.tables WHERE table_schema='$name' AND table_name='destinations'");
if ($exists && $exists->num_rows > 0) {
    echo "[seed] database '$name' already seeded\n";
    exit(0);
}

echo "[seed] seeding database '$name'\n";
$sql = file_get_contents(__DIR__ . "/../database/tourism_db.sql");
if (!$conn->multi_query($sql)) {
    fwrite(STDERR, "[seed] error: " . $conn->error . "\n");
    exit(1);
}
do { if ($r = $conn->store_result()) $r->free(); } while ($conn->more_results() && $conn->next_result());
if ($conn->errno) { fwrite(STDERR, "[seed] error: " . $conn->error . "\n"); exit(1); }
echo "[seed] done\n";
