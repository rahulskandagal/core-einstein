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
    migrate($conn, $name);
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

/**
 * Small idempotent data migrations for databases seeded by older versions.
 */
function migrate(mysqli $conn, string $name): void {
    $conn->select_db($name);
    // v1 seed referenced local image files that were never shipped; use hosted photos.
    $map = [
        'bali_main.jpg'      => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=1200&q=80',
        'swiss_main.jpg'     => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=1200&q=80',
        'paris_main.jpg'     => 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&w=1200&q=80',
        'santorini_main.jpg' => 'https://images.unsplash.com/photo-1613395877344-13d4a8e0d49e?auto=format&fit=crop&w=1200&q=80',
        // interim Swiss Alps photo turned out to be an aurora shot
        'https://images.unsplash.com/photo-1531366936337-7c912a4589a7?auto=format&fit=crop&w=1200&q=80' => 'https://images.unsplash.com/photo-1530122037265-a5f1f91d3b99?auto=format&fit=crop&w=1200&q=80',
    ];
    $st = $conn->prepare("UPDATE destinations SET image_main=? WHERE image_main=?");
    $n = 0;
    foreach ($map as $old => $new) { $st->bind_param("ss", $new, $old); $st->execute(); $n += $st->affected_rows; }
    if ($n) echo "[seed] migrated $n destination image(s)\n";
}
