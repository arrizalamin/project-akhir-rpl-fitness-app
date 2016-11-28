#!/usr/bin/env php
<?php
class Migration {
    private $db;
    private $up;
    private $down;
    private $filename;

    public function __construct($filename, mysqli $connection)
    {
        $this->db = $connection;
        $file = file_get_contents('databases/' . $filename);
        $this->up = substr($file, 0, strpos($file, '-- DOWN'));
        $this->down = substr($file, strpos($file, '-- DOWN'));
        $this->filename = $filename;
    }

    public function up() {
        print "migrating : " . $this->filename;
        $this->db->query($this->up);
    }

    public function down() {
        print "rollback : " . $this->filename;
        $this->db->query($this->down);
    }
}

$dbConfig = json_decode(file_get_contents('config.json'))->database;
$conn = mysqli_connect($dbConfig->host, $dbConfig->user, $dbConfig->password, $dbConfig->name);

$migrations = array_map(function($file) use($conn) {
    return new Migration($file, $conn);
}, array_slice(scandir('databases'), 2));

foreach ($migrations as $migration) {
    if ($argv[1] == 'migrate') {
        $migration->up();
    } elseif ($argv[1] == 'rollback') {
        $migration->down();
    }
}
