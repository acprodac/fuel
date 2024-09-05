<?php
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbidden');

$domain = $_SERVER['SERVER_NAME'];
if(strpos($domain, 'localhost') !== FALSE){
    define('PROJ_MOD', 'dev');
} elseif(strpos($domain, 'studiowox') !== FALSE){
    define('PROJ_MOD', 'homolog');
} elseif(strpos($domain, 'hospedagemdesites.ws') !== FALSE){
    define('PROJ_MOD', 'staging');
} else {
    define('PROJ_MOD', 'prod');
}


//------------------------------------------------------------------------------
// DON'T COPY THIS VARIABLES IN .config FILES
//------------------------------------------------------------------------------

$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/'); // don't touch this configuration

//**********************
//Path configuration
//**********************
// In this configuration the folder tree is
// root
//   |- site
//   |    |- source <- upload folder
//   |    |- js
//   |    |   |- tinymce
//   |    |   |    |- plugins
//   |    |   |    |-   |- filemanager
//   |    |   |    |-   |-      |- thumbs <- folder of thumbs [must have the write permission]

switch(PROJ_MOD){
    case 'dev':
        $base_url="http://localhost";
        $upload_dir = '/prodac/www/upload/img/_textarea/';
        $current_path = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . '_textarea/';
        break;
    case 'homolog':
        $base_url="http://studiowox.com.br";
        $upload_dir = '/clientes/prodac/www/upload/img/_textarea/';
        $current_path = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . '_textarea/';
        break;
    case 'staging':
        $base_url="";
        $upload_dir = '/clientes/prodac/www/upload/img/_textarea/';
        $current_path = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . '_textarea/';
        break;
    case 'prod':
        $base_url="";
        $upload_dir = '/clientes/prodac/www/upload/img/_textarea/';
        $current_path = '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . '_textarea/';
}

//------------------------------------------------------------------------------
// YOU CAN COPY AND CHANGE THIS VARIABLES IN .config FILES
//------------------------------------------------------------------------------

$MaxSizeUpload=100; //Mb

//**********************
//Image config
//**********************

//parameter passed on editor
$image_dimension_passing=1; //1 mean than filemanager pass on editor also the pixel dimension of image else 0

//set max width pixel or the max height pixel for all images
//If you set dimension limit, automatically the images that exceed this limit are convert to limit, instead
//if the images are lower the dimension is maintained
//if you don't have limit set both to 0
$image_max_width=0;
$image_max_height=0;

//Automatic resizing //
//If you set true $image_resizing the script convert all images uploaded in image_width x image_height resolution
//If you set width or height to 0 the script calcolate automatically the other size
$image_resizing=false;
$image_width=0;
$image_height=0;

//******************
//Default layout setting
//
// 0 => boxes
// 1 => list (1 column)
// 2 => columns list (multiple columns depending on the width of the page)
//
// YOU CAN ALSO PASS THIS PARAMETERS USING SESSION VAR => $_SESSION["VIEW"]=
//
//******************
$default_view=0;

//******************
//Permits config
//******************
$delete_files=true;
$create_folders=true;
$delete_folders=true;
$upload_files=true;
$rename_files=true;
$rename_folders=true;

//**********************
//Allowed extensions
//**********************
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff', 'svg', 'svgz'); //Images
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','log','fla','xml','ade','adp','ppt','pptx'); //Files
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma'); //Videos
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid'); //Music
$ext_misc = array('zip', 'rar','gzip'); //Archives
$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //allowed extensions

//**********************
//Hidden file and folder
//**********************
//set the name of hidden folders... remember than this name will be hidden in all folders (you can change in .config file if have exceptions)
$hidden_folders = array();
//set the name of hidden files...  remember than this name will be hidden in all folders (ex: "document.pdf", "image.jpg" )
$hidden_files = array();

/*******************
 * JAVA upload 
 *******************/
$java_upload=true;
$MaxJAVASizeUpload=200; //Gb
?>
