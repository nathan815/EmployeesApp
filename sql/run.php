<?php
#/bin/sh

$config = parse_ini_file('../env.ini');

$commandBegin = "mysql -u{$config['db_username']} -p{$config['db_password']} ";
$commandBegin .= "-h {$config['db_host']} -D {$config['db_name']}";

echo "Begin SQL Runner\n";

echo $commandBegin . "\n";

$files = scandir('./');
$files = array_filter($files, function($file) {
    return strpos($file, '.sql') !== false;
});

foreach($files as $file) {
    echo "Running $file...\n";
    $file = __DIR__ . DIRECTORY_SEPARATOR . $file;
    $command =  "$commandBegin < $file";
    shell_exec($command);
}

echo "Done";