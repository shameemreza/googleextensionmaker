<?php
/* Generate International Version */
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
			/* GET VARIABLE FROM THE FORM */
			$default_locale=unescape($_POST['default_locale']);
			$version=trim($_POST['version']);
			$url=trim($_POST['url']);
			$manifest='manifest.json';
	$dirbase = 'output/shameem_'.time().'_'.$default_locale.'_V'.$version;		
	mkdir($dirbase, 0777, true);
		if(!empty($_POST['default_locale']) AND !empty($_POST['version']) AND !empty($_POST['url'])){
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
					move_uploaded_file($_FILES["file"]["tmp_name"],"./$dirbase/" . $_FILES["file"]["name"]);
					$icon=$_FILES["file"]["name"];	
				}
			
			
$data='{';
$data.="\r\n".' "name": "__MSG_appName__",';
$data.="\r\n".' "description": "__MSG_appDesc__",'; 
$data.="\r\n".' "manifest_version": 2,';
$data.="\r\n".' "version": "'.$version.'",';
$data.="\r\n".' "default_locale": "'.$default_locale.'",';
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
			/* CREATE THE FILE AND DIRECTORY */			
			// Desired folder structure
			$structure = "./$dirbase/_locales/";
			
			if(mkdir($structure, 0777, true)){								
				/* CREATE THE FILE manifest.json*/				
				$fichier=fopen("./$dirbase/$manifest","a+"); 
				fputs($fichier,$data);  // Write the email(s) in the text file
				fclose($fichier);
				/* CREATE THE DIRECTORY AND FILE (manifest.json) FOR EACH LANGUAGE */
$array_lang=Array("ar"=>"Arabic","am"=>"Amharic","bg"=>"Bulgarian","bn"=>"Bengali","ca"=>"Catalan","cs"=>"Czech","da"=>"Danish",
"de"=>"German","el"=>"Greek","en"=>"English","en_GB"=>"English (Great Britain)","en_US"=>"English (USA)","es"=>"Spanish",
"es_419"=>"Spanish (Latin America and Caribbean)","et"=>"Estonian","fa"=>"Persian","fi"=>"Finnish","fil"=>"Filipino",
"fr"=>"French","gu"=>"Gujarati","he"=>"Hebrew","hi"=>"Hindi","hr"=>"Croatian","hu"=>"Hungarian","id"=>"Indonesian","it"=>"Italian",
"ja"=>"Japanese","kn"=>"Kannada","ko"=>"Korean","lt"=>"Lithuanian","lv"=>"Latvian","ml"=>"Malayalam","mr"=>"Marathi",
"ms"=>"Malay","nl"=>"Dutch","no"=>"Norwegian","pl"=>"Polish","pt_BR"=>"Portuguese (Brazil)","pt_PT"=>"Portuguese (Portugal)",
"ro"=>"Romanian","ru"=>"Russian","sk"=>"Slovak","sl"=>"Slovenian","sr"=>"Serbian","sv"=>"Swedish","sw"=>"Swahili","ta"=>"Tamil",
"te"=>"Telugu","th"=>"Thai","tr"=>"Turkish","uk"=>"Ukrainian","vi"=>"Vietnamese","zh_CN"=>"Chinese (China)","zh_TW"=>"Chinese (Taiwan)");					
			
				foreach($array_lang as $code=>$value) {
				$app_name='app_name_'.$code;
				$app_description='app_description_'.$code;
				$error=TRUE;
					if(!empty($_POST[$app_name])){ 
							$structure1 = $structure.'/'.$code.'/';
							mkdir($structure1, 0777, true);
							$manifest='messages.json';
							$fichier=fopen("$structure1/$manifest","a+"); 
							$app_name_value=$_POST[$app_name];
							$app_description_value=$_POST[$app_description];
$data='{
 "appName": {
 "message": "'.$app_name_value.'"
 },
 "appDesc": {
 "message": "'.$app_description_value.'"
 }
}';
							
							fputs($fichier,$data);  // Write the email(s) in the text file
							fclose($fichier);
							if(!$fichier){ $error=FALSE; }
					}		
				}			
				
			
			if($error){
					$return['msg'] = '<div class="fcorn-shortcodes ">
									<div class="col-md-12 col-sm-12 notify">
										<div class="success">
											<span class="entypo-thumbs-up msg">Your Google Chrome App has been created. Name of the zip file : <a href="./'.$dirbase.'">'.$dirbase.' </a>(click on the link or open the Output folder)</span>										
										</div>
									</div>		
								</div>';
								
			}else{
				$return['msg'] = '<div class="fcorn-shortcodes ">						
							<div class="col-md-12 col-sm-12 notify">
								<div class="error">
									<span class="entypo-block msg">Error creating the files. Try again in a few moments and check that you have write permissions for this directory</span>
								</div>
							</div>			
						</div>';
			}
		
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
