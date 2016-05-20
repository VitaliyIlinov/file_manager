<?php
/**
 * Created by PhpStorm.
 * User: Илья
 * Date: 20.05.2016
 * Time: 13:57
 */
function get_files()
{
    $cd = getcwd();
    $dh = opendir($cd);
    while (($file = readdir($dh)) !== false) {
        $file_path = $cd . DIRECTORY_SEPARATOR . $file;
        yield [
            'is_dir' => is_dir($file_path),
            'file_size' => filesize($file_path),
            'file_path' => $file_path,
        ] => $file;
    }
    closedir($dh);
}

function render(){
    $opened_file = null;
    if ($_GET) {
        //print_r($_GET);
        $go_to = $_GET['go_to']?? null;
        $open = $_GET['open']?? null;
        if ($go_to !== null) {
            if (is_dir($go_to)) {
                chdir($go_to);
            } else {
                throw new Error('Mistake');
            }
        } elseif ($open !== null) {
            if (file_exists($open)) {
                //$img=pathinfo($open,PATHINFO_EXTENSION);
                $opened_file = [];
                $opened_file['type'] = pathinfo($open,PATHINFO_EXTENSION);
                $opened_file['file_name'] = basename($open);
                if (isset($_POST['submit'])) {
                    file_put_contents($opened_file['file_name'], $_POST['content']);
                }
                $opened_file['content'] = htmlspecialchars(file_get_contents($open));
            } else {
                throw new Error('File dont exist');
            }
        }
    }

    include 'main_1.php';
}

render();
