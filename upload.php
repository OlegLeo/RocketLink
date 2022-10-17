<?php

// RESPONSE FUNCTION
function verbose($ok=1,$info=""){
   
  // THROW A 400 ERROR ON FAILURE
  if ($ok==0) { http_response_code(400); }
  die(json_encode(["ok"=>$ok, "info"=>$info]));
}
// INVALID UPLOAD
if (empty($_FILES) || $_FILES['file']['error']) {
  verbose(0, "Failed to move uploaded file.");
}
// THE UPLOAD DESITINATION - CHANGE THIS TO YOUR OWN

$filePath = __DIR__ . DIRECTORY_SEPARATOR . "uploads/";
if (!file_exists($filePath)) { 
  if (!mkdir($filePath, 0777, true)) {
    verbose(0, "Failed to create $filePath");
  }
}
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];

$filePath = $filePath . DIRECTORY_SEPARATOR . $fileName;

// DEAL WITH CHUNKS
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
  $in = @fopen($_FILES['file']['tmp_name'], "rb");
  if ($in) {
    while ($buff = fread($in, 4096)) { fwrite($out, $buff); }
  } else {
    verbose(0, "Failed to open input stream");
  }
  @fclose($in);
  @fclose($out);
  @unlink($_FILES['file']['tmp_name']);
} else {
  verbose(0, "Failed to open output stream");
}
// CHECK IF FILE HAS BEEN UPLOADED
if (!$chunks || $chunk == $chunks - 1) {

  //UPLOAD DONE
  rename("{$filePath}.part", $filePath);

  // GENERATING A DIRECTORY RANDOM ID FOLDER ---> USER_XXXXXXX 
  //$folderid = (rand(100000,9999999999999));             ******!!!!!!!!! apagar
  //$link = "USER_$folderid";                             ******!!!!!!!!!! apagar
  
  $folderid = file_get_contents('D:/XAMPP/htdocs/folderID.txt');    //NOVOteste *******

  //CREATING A NEW DIRECTORY ON THE SERVER
  mkdir("D:/XAMPP/htdocs/uploads/USER_$folderid", 0755, true);   
  
  $folderid = file_get_contents('D:/XAMPP/htdocs/folderID.txt');    //NOVOteste *******


  // MOVING THE THE FILE INTO A DIRECTORY RANDOMLY CREATED (USER_XXXXXX)
  rename("uploads/$fileName", "uploads/USER_$folderid/$fileName");

   //ZIPPING THE DIRECTORY

    // Initialize archive object
    class GoodZipArchive extends ZipArchive 
    {
      //@author Nicolas Heimann
      public function __construct($a=false, $b=false) { $this->create_func($a, $b);  }
      
      public function create_func($input_folder=false, $output_zip_file=false)
      {
        if($input_folder !== false && $output_zip_file !== false)
        {
          $res = $this->open($output_zip_file, ZipArchive::CREATE);
          if($res === TRUE) 	{ $this->addDir($input_folder, basename($input_folder)); $this->close(); }
          else  				{ echo 'Could not create a zip archive. Contact Admin.'; }
        }
      }
      
        // Add a Dir with Files and Subdirs to the archive
        public function addDir($location, $name) {
            $this->addEmptyDir($name);
            $this->addDirDo($location, $name);
        }
    
        // Add Files & Dirs to archive 
        private function addDirDo($location, $name) {
            $name .= '/';         $location .= '/';
          // Read all Files in Dir
            $dir = opendir ($location);
            while ($file = readdir($dir))    {
                if ($file == '.' || $file == '..') continue;
              // Rekursiv, If dir: GoodZipArchive::addDir(), else ::File();
                $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
                $this->$do($location . $file, $name . $file);
            }
        }
         
      }
      new GoodZipArchive("./uploads/USER_$folderid",    "./uploads/USER_$folderid.zip") ;
      
      // DELETING THE FOLDER THATS ISNT A .ZIP FILE (KEEPING ONLY A ZIP FILE)

        function deleteDirectory($path){

            $files = array_diff(scandir($path), array('.','..'));
            foreach($files as $file){
            (is_dir("$path/$file")) ? deleteDirectory("$path/$file") : unlink("$path/$file");
            }
            return rmdir($path);
            }
            $path =$_SERVER['DOCUMENT_ROOT']."/uploads/USER_$folderid";
            deleteDirectory($path);   
           
            //CREATING A .txt FILE FOR EXPORTING THE DIRECTORY NAME FOR TEMPORARY USE ONLY.
            /*$myfile = fopen("folderID.txt", "w") or die("Unable to open file!");
            $txt = $folderid;
            fwrite($myfile, $txt);
            fclose($myfile);*/


            
    }

//killing the loop 
verbose(1, "Upload OK");

?>

		



