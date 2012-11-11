<?php
$del_folder_name=$_POST['del_dir_name'];


rrmdir('output/'.$del_folder_name);
echo '1';



# recursively remove a directory
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}
?>