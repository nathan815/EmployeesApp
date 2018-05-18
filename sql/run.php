<?php
#/bin/sh

$config = parse_ini_file('../env.ini');

$commandBegin = "mysql -u{$config['db_username']} -p{$config['db_password']} ";
$commandBegin .= "-h {$config['db_host']} -D {$config['db_name']}";

echo "Begin SQL Runner\n";

echo $commandBegin . "\n";

$files = scandir('./');
$files = array_filter($files, function($file) {
    return strpos($file, '.sql') > -1;
});

foreach($files as $file) {
    $file = __DIR__ . DIRECTORY_SEPARATOR . $file;
    echo "Running $file...\n";
    $command =  "$commandBegin < $file";
    $output = shell_exec($command);
    $output = substr(strlen)
    echo $output;
}

echo 'Done';