<?php
/* Get Zip Output */
function ZipStatusString( $status )
{
    switch( (int) $status )
    {
        case ZipArchive::ER_OK           : return 'no-error';
        case ZipArchive::ER_MULTIDISK    : return 'Multi-disk zip archives not supported';
        case ZipArchive::ER_RENAME       : return 'Renaming temporary file failed';
        case ZipArchive::ER_CLOSE        : return 'Closing zip archive failed';
        case ZipArchive::ER_SEEK         : return 'Seek error';
        case ZipArchive::ER_READ         : return 'Read error';
        case ZipArchive::ER_WRITE        : return 'Write error';
        case ZipArchive::ER_CRC          : return 'CRC error';
        case ZipArchive::ER_ZIPCLOSED    : return 'Containing zip archive was closed';
        case ZipArchive::ER_NOENT        : return 'No such file';
        case ZipArchive::ER_EXISTS       : return 'File already exists';
        case ZipArchive::ER_OPEN         : return 'Can\'t open file';
        case ZipArchive::ER_TMPOPEN      : return 'Failure to create temporary file';
        case ZipArchive::ER_ZLIB         : return 'Zlib error';
        case ZipArchive::ER_MEMORY       : return 'Malloc failure';
        case ZipArchive::ER_CHANGED      : return 'Entry has been changed';
        case ZipArchive::ER_COMPNOTSUPP  : return 'Compression method not supported';
        case ZipArchive::ER_EOF          : return 'Premature EOF';
        case ZipArchive::ER_INVAL        : return 'Invalid argument';
        case ZipArchive::ER_NOZIP        : return 'Not a zip archive';
        case ZipArchive::ER_INTERNAL     : return 'Internal error';
        case ZipArchive::ER_INCONS       : return 'Zip archive inconsistent';
        case ZipArchive::ER_REMOVE       : return 'Can\'t remove file';
        case ZipArchive::ER_DELETED      : return 'Entry has been deleted';
        
        default: return sprintf('Unknown status %s', $status );
    }
}
function unescape($text) 
{ 
  if(get_magic_quotes_gpc()) 
  { 
    $text = stripslashes($text); 
  } 
  $text = trim($text); 
  return($text); 
}
/* Form validation to display the generated code */
class ajaxValidate {
	function formValidate() {
	$return = array();
	$return['msg'] = '';
		if(!empty($_POST['name']) AND !empty($_POST['version']) AND !empty($_POST['url'])){
			/* GET THE ICON FILE */
			if(!empty($_FILES["file"]["name"]) AND !empty($_FILES["file"]["error"])){
				$return['msg'] = '<div class="fcorn-shortcodes ">						
							<div class="col-md-12 col-sm-12 notify">
								<div class="error">
									<span class="entypo-block msg">Import file error ('.$_FILES["file"]["error"].'). Check if you have right to import a file</span>
								</div>
							</div>			
						</div>';
			}else{
				if(!empty($_FILES["file"]["tmp_name"])){
					move_uploaded_file($_FILES["file"]["tmp_name"],"./" . $_FILES["file"]["name"]);
					$icon=$_FILES["file"]["name"];	
				}
			/* GET VARIABLE FROM THE FORM */
			$name=unescape($_POST['name']);
			$version=trim($_POST['version']);
			$url=trim($_POST['url']);
			$manifest='manifest.json';
			$fichier=fopen("./$manifest","a+"); 
$data='{';
$data.="\r\n".' "name": "'.$name.'",';
$data.="\r\n".' "manifest_version": 2,';
if(!empty($_POST['short_name'])){ $short_name=unescape($_POST['short_name']);
$data.="\r\n".' "short_name": "'.$short_name.'",'; }
if(!empty($_POST['description'])){ $description=unescape($_POST['description']);
$data.="\r\n".' "description": "'.$description.'",'; }
$data.="\r\n".' "version": "'.$version.'",';
if(!empty($icon)){
$data.="\r\n".' "icons": {
	"128": "'.$icon.'"
  },';
}
$data.="\r\n".' "app": {
	"launch": {
	  "web_url": "'.$url.'"
	}
  }
}';			
			if($fichier){
				/* CREATE THE FILE manifest.json*/
				fputs($fichier,$data);  // Write the email(s) in the text file
				fclose($fichier);
				/* ZIP THE FILE CREATED (manifest.json) AND THE ICON */
				$zip = new ZipArchive();
				$app_name = str_replace(' ', '-', $name);
				$app_name = strtolower($app_name);				
				$filename = "shameem_".$app_name."_v".$version.".zip";
					if ($zip->open("./output/".$filename, ZipArchive::CREATE)!==TRUE) {
						$return['msg'] = '<div class="fcorn-shortcodes ">						
								<div class="col-md-12 col-sm-12 notify">
									<div class="error">
										<span class="entypo-block msg">Error creating the zip file (cannot open the file-'.$filename.'). Try again in a few moments and check that you have write permissions for this directory</span>
									</div>
								</div>			
							</div>';
					}else{
						if(!empty($icon)){
							$zip->addFile("./" . $icon,$icon);
						}
						$zip->addFile("./" . "manifest.json","manifest.json");
						$zipstatus=ZipStatusString($zip->status);
						$zip->close();
						if($zipstatus=='no-error'){ 
							$return['msg'] = '<div class="fcorn-shortcodes ">
									<div class="col-md-12 col-sm-12 notify">
										<div class="success">
											<span class="entypo-thumbs-up msg">Your Google Chrome App has been created. Name of the zip file : <a href="./output/'.$filename.'">'.$filename.' </a>(click on the link or open the Output folder)</span>										
										</div>
									</div>		
								</div>';
							
					   }else{ 
							$return['msg'] = '<div class="fcorn-shortcodes ">						
								<div class="col-md-12 col-sm-12 notify">
									<div class="error">
										<span class="entypo-block msg">Error creating the zip file. Error type : <strong>'.$zipstatus.'</strong> - Check also that you have write permissions for this folder or if you have not already created the same Chrome App (same name and version number).</span>
									</div>
								</div>			
							</div>';
					   }
					   unlink('manifest.json');
					   if(!empty($icon)){  unlink($icon);	}					   
					}				
			}else{
				$return['msg'] = '<div class="fcorn-shortcodes ">						
							<div class="col-md-12 col-sm-12 notify">
								<div class="error">
									<span class="entypo-block msg">Error creating the file. Try again in a few moments and check that you have write permissions for this directory</span>
								</div>
							</div>			
						</div>';
			}
		}// END CHECK IF FILE IMPORT ERROR
		}else{		
			$return['msg'] = '<div class="fcorn-shortcodes ">						
							<div class="col-md-12 col-sm-12 notify">
								<div class="error">
									<span class="entypo-block msg">Some field empty</span>
								</div>
							</div>			
						</div>';
		}
	return $return;
	}
}
$ajaxValidate = new ajaxValidate;
$display = $ajaxValidate->formValidate();
echo $display['msg'];
?>
