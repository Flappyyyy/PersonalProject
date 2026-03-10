<?php
try {
    $pdo = new PDO('pgsql:host=db.npowsccqwyrfieqkvxrn.supabase.co;dbname=postgres', 'postgres', 'test');
    echo "Connected successfully!";
}
catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
