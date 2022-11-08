<?php

$ds = DIRECTORY_SEPARATOR;
$base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;

include_once "{$base_dir}BaseModel.php";

class MultiUploadAjax extends BaseModel
{
//    function multi_upload_ajax_temp_filename()
//    {
//        $output = '';
//        if (is_array($_FILES)) {
//
//            foreach ($_FILES['images']['name'] as $name => $value) {
//
//                $file_name = explode(".", $_FILES['images']['name'][$name]);
//                $allowed_extension = array("jpg", "jpeg", "png", "gif");
//                if (in_array($file_name[1], $allowed_extension)) {
//                    $new_name = rand() . '.' . $file_name[1];
//                    $sourcePath = $_FILES["images"]["tmp_name"][$name];
//                    $targetPath = "uploads/" . $new_name;
//
//                    if (!file_exists('uploads')) {
//                        mkdir("uploads", 0755);
//                        move_uploaded_file($sourcePath, $targetPath);
//                    }
//
//                }
//            }
//            $ds = DIRECTORY_SEPARATOR;
//            $base_dir = realpath(dirname(__FILE__) . $ds . '..' . $ds . '..') . $ds;
//            $images = glob("{$base_dir}uploads/*.*");
//            foreach ($images as $image) {
//                $output .= '<div class="col-md-2" align="center" ><img src="' . $image . '" width="180px" height="180px" style="border:1px solid #ccc;" /></div>';
//            }
//            echo $output;
//        }
//
//
//    }


//    function multi_upload_ajax()
//    {
//        if (is_array($_FILES)) {
//
//            foreach ($_FILES['images']['name'] as $name => $value) {
//
//                $file_name = explode(".", $_FILES['images']['name'][$name]);
//
//                $allowed_extension = array("jpg", "jpeg", "png", "gif");
//                if (in_array($file_name[1], $allowed_extension)) {
////                    $new_name = rand() . '.' . $file_name[1];
//                    $sourcePath = $_FILES["images"]["tmp_name"][$name];
////                    $targetPath = "uploads/" . $new_name;
//
////                    $targetPath = "uploads/" . $_FILES['images']['name'];
//                    $targetPath = "uploads/" . $value;
//
//                    if (!file_exists('uploads')) {
//                        mkdir("uploads", 0755);
//                        move_uploaded_file($sourcePath, $targetPath);
//                    } else {
//                        move_uploaded_file($sourcePath, $targetPath);
//                    }
//
//                }
//            }
//        }
//
//
//    }


    function multi_upload_ajax()
    {
        if (is_array($_FILES)) {

            foreach ($_FILES['images']['name'] as $name => $value) {

                $file_name = explode(".", $_FILES['images']['name'][$name]);

                $allowed_extension = array("jpg", "jpeg", "png", "gif");
                if (in_array($file_name[1], $allowed_extension)) {
                    $sourcePath = $_FILES["images"]["tmp_name"][$name];

                    $targetPath = "uploads/" . $value;

                    if (!file_exists('uploads')) {
                        mkdir("uploads", 0755);
                        move_uploaded_file($sourcePath, $targetPath);
                    } else {
                        move_uploaded_file($sourcePath, $targetPath);
                    }

                }
            }
        }


    }


    function read_files()
    {
        $ds = DIRECTORY_SEPARATOR;
        $data_dir = realpath(dirname(__FILE__) . $ds) . $ds . "data" . $ds . "uploads" . $ds;

        $output = [];

        if (file_exists($data_dir)) {
            $images = scandir($data_dir);

            foreach ($images as $image) {
                array_push($output, $image);
            }
        } else {
            echo "no data";
        }
        echo json_encode($output);
    }

}
