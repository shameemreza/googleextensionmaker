<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>App Creator - International Version</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="author" content="Shameem Reza">
		<link rel="stylesheet" href="icons/styles.css">
		<link rel="stylesheet" href="css/bootstrap-custom.css">
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/contact-form.css">	
		<link rel="stylesheet" href="css/shortcodes.css">		
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,600' rel='stylesheet' type='text/css'>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>	
	</head>
	<body >
<?php
$array_lang=Array("ar"=>"Arabic",
"am"=>"Amharic",
"bg"=>"Bulgarian",
"bn"=>"Bengali",
"ca"=>"Catalan",
"cs"=>"Czech",
"da"=>"Danish",
"de"=>"German",
"el"=>"Greek",
"en"=>"English",
"en_GB"=>"English (Great Britain)",
"en_US"=>"English (USA)",
"es"=>"Spanish",
"es_419"=>"Spanish (Latin America and Caribbean)",
"et"=>"Estonian",
"fa"=>"Persian",
"fi"=>"Finnish",
"fil"=>"Filipino",
"fr"=>"French",
"gu"=>"Gujarati",
"he"=>"Hebrew",
"hi"=>"Hindi",
"hr"=>"Croatian",
"hu"=>"Hungarian",
"id"=>"Indonesian",
"it"=>"Italian",
"ja"=>"Japanese",
"kn"=>"Kannada",
"ko"=>"Korean",
"lt"=>"Lithuanian",
"lv"=>"Latvian",
"ml"=>"Malayalam",
"mr"=>"Marathi",
"ms"=>"Malay",
"nl"=>"Dutch",
"no"=>"Norwegian",
"pl"=>"Polish",
"pt_BR"=>"Portuguese (Brazil)",
"pt_PT"=>"Portuguese (Portugal)",
"ro"=>"Romanian",
"ru"=>"Russian",
"sk"=>"Slovak",
"sl"=>"Slovenian",
"sr"=>"Serbian",
"sv"=>"Swedish",
"sw"=>"Swahili",
"ta"=>"Tamil",
"te"=>"Telugu",
"th"=>"Thai",
"tr"=>"Turkish",
"uk"=>"Ukrainian",
"vi"=>"Vietnamese",
"zh_CN"=>"Chinese (China)",
"zh_TW"=>"Chinese (Taiwan)");

function display_name($code){ 
	echo '<div class="input-wrap">
			<span class="entypo-star icon"><input id="textinput" name="app_name_'.$code.'" type="text" placeholder="Name of your Chrome App (max 12 characters recommended)" class="form-control input-md" required=""></span>
			<span class="entypo-info-circled icon"><input id="textinput" name="app_description_'.$code.'" type="text" placeholder="Pithy description (132 characters or less, no HTML" class="form-control input-md" required=""></span>
	 </div>';
}
function display_checkbox($code,$name){
echo '					<div class="col-md-4 col-sm-4">
							<label class="check-label">
								<input type="checkbox" name="checkboxes_lang[]" class="check-input" value="'.$code.'">
								<span class="info">'.$name.'</span>
							</label>
						</div>';
}
?>
<?php if(!empty($_POST['step1'])){ ?>
		<!-- Chrome App Creator Form Step2 -->
		<div class="fcorn-shortcodes" > 
			<form method="post" class="fcorn-contact container" id="form2" enctype="multipart/form-data" onsubmit="return submitForm();" >
				<div class="col-md-5 col-sm-5 contact-left">
					<h2 class="head" style="font-size:18px">App Creator - International Version</h2>
					<label for="contact-version" class="input-label">Icon (128x128px .png)</label>
					<input type="submit" value="Make my App *Final" name="step1" class="contact-btn">
				</div>
				<div class="col-md-7 col-sm-7 contact-right ">
					<ul class="social">
						<br><br>
					</ul>
					<div class="input-wrap ">					
						<div class="col-md-12 col-sm-12 file-input">
							<label for="file98">
								<span class="btn right"><input type="file" name="file" size="50" id="file98" onchange="this.parentNode.parentNode.nextElementSibling.value = this.value">Choose File</span>
							</label>
							<input type="text" name="file" placeholder="No file choosen" class="file-replacer right" readonly>
						</div>
						<?php 
							echo '<h3>'.$array_lang[$_POST['default_locale']].' (default)</h3>'; 
							display_name($_POST['default_locale']);
							if(!empty($_POST['checkboxes_lang'])) {
								foreach($_POST['checkboxes_lang'] as $check) {
										echo '<h3>'.$array_lang[$check].'</h3>'; 
										display_name($check);
								}
							}
						?>
						<span id="info1"></span>
					</div>					
				</div>
				<input type="hidden" name="default_locale" value="<?php echo $_POST['default_locale']; ?>">
				<input type="hidden" name="version" value="<?php echo $_POST['version']; ?>">
				<input type="hidden" name="url" value="<?php echo $_POST['url']; ?>">
			</form>			
		</div>	
		
<?php }else{ ?>

		<!-- Chrome App Creator Form -->
		<div class="fcorn-shortcodes" > 
			<form method="post" class="fcorn-contact container" id="form1" >
				<div class="col-md-5 col-sm-5 contact-left">
					<h2 class="head" style="font-size:16px">App Creator - International Version</h2>
					<label for="contact-version" class="input-label">Version *</label>
					<label for="contact-url" class="input-label">URL to redirect *</label>
					<label for="contact-default_language" class="input-label">Default Language *</label>
					<label for="contact-url" class="input-label">Choose the languages you want *</label>
					<input type="submit" value="Make my App *Step1" name="step1" class="contact-btn">
				</div>
				<div class="col-md-7 col-sm-7 contact-right ">
					<ul class="social">
						<br><br>
					</ul>
					<div class="input-wrap ">					
						<span class="entypo-arrows-ccw icon"><input type="text" name="version" id="contact-version" required></span>
						<span class="entypo-export icon"><input type="text" name="url" placeholder="http://" id="contact-url" required></span>
						<div class="contact-depart-wrap">
							<select id="contact-default_language" name="default_locale" class="contact-depart">
							 	<option value="ar">Arabic</option>
								<option value="am">Amharic</option>
								<option value="bg">Bulgarian</option>
								<option value="bn">Bengali</option>
								<option value="ca">Catalan</option>
								<option value="cs">Czech</option>
								<option value="da">Danish</option>
								<option value="de">German</option>
								<option value="el">Greek</option>
								<option value="en" selected>English</option>
								<option value="en_GB">English (Great Britain)</option>
								<option value="en_US">English (USA)</option>
								<option value="es">Spanish</option>
								<option value="es_419">Spanish (Latin America and Caribbean)</option>
								<option value="et">Estonian</option>
								<option value="fa">Persian</option>
								<option value="fi">Finnish</option>
								<option value="fil">Filipino</option>
								<option value="fr">French</option>
								<option value="gu">Gujarati</option>
								<option value="he">Hebrew</option>
								<option value="hi">Hindi</option>
								<option value="hr">Croatian</option>
								<option value="hu">Hungarian</option>
								<option value="id">Indonesian</option>
								<option value="it">Italian</option>
								<option value="ja">Japanese</option>
								<option value="kn">Kannada</option>
								<option value="ko">Korean</option>
								<option value="lt">Lithuanian</option>
								<option value="lv">Latvian</option>
								<option value="ml">Malayalam</option>
								<option value="mr">Marathi</option>
								<option value="ms">Malay</option>
								<option value="nl">Dutch</option>
								<option value="no">Norwegian</option>
								<option value="pl">Polish</option>
								<option value="pt_BR">Portuguese (Brazil)</option>
								<option value="pt_PT">Portuguese (Portugal)</option>
								<option value="ro">Romanian</option>
								<option value="ru">Russian</option>
								<option value="sk">Slovak</option>
								<option value="sl">Slovenian</option>
								<option value="sr">Serbian</option>
								<option value="sv">Swedish</option>
								<option value="sw">Swahili</option>
								<option value="ta">Tamil</option>
								<option value="te">Telugu</option>
								<option value="th">Thai</option>
								<option value="tr">Turkish</option>
								<option value="uk">Ukrainian</option>
								<option value="vi">Vietnamese</option>
								<option value="zh_CN">Chinese (China)</option>
								<option value="zh_TW">Chinese (Taiwan)</option>
							</select>
						</div>
					</div>
					<div class="row">
						<?php
							display_checkbox('ar','Arabic');
							display_checkbox('am','Amharic');
							display_checkbox('bg','Bulgarian');
							display_checkbox('bn','Bengali');
							display_checkbox('ca','Catalan');
							display_checkbox('cs','Czech');
							display_checkbox('da','Danish');
							display_checkbox('de','German');
							display_checkbox('el','Greek');
							display_checkbox('en','English');
							display_checkbox('en_GB','English (Great Britain)');
							display_checkbox('en_US','English (USA)');
							display_checkbox('es','Spanish');
							display_checkbox('es_419','Spanish (Latin America and Caribbean)');
							display_checkbox('et','Estonian');
							display_checkbox('fa','Persian');
							display_checkbox('fi','Finnish');
							display_checkbox('fil','Filipino');
							display_checkbox('fr','French');
							display_checkbox('gu','Gujarati');
							display_checkbox('he','Hebrew');
							display_checkbox('hi','Hindi');
							display_checkbox('hr','Croatian');
							display_checkbox('hu','Hungarian');
							display_checkbox('id','Indonesian');
							display_checkbox('it','Italian');
							display_checkbox('ja','Japanese');
							display_checkbox('kn','Kannada');
							display_checkbox('ko','Korean');
							display_checkbox('lt','Lithuanian');
							display_checkbox('lv','Latvian');
							display_checkbox('ml','Malayalam');
							display_checkbox('mr','Marathi');
							display_checkbox('ms','Malay');
							display_checkbox('nl','Dutch');
							display_checkbox('no','Norwegian');
							display_checkbox('pl','Polish');
							display_checkbox('pt_BR','Portuguese (Brazil)');
							display_checkbox('pt_PT','Portuguese (Portugal)');
							display_checkbox('ro','Romanian');
							display_checkbox('ru','Russian');
							display_checkbox('sk','Slovak');
							display_checkbox('sl','Slovenian');
							display_checkbox('sr','Serbian');
							display_checkbox('sv','Swedish');
							display_checkbox('sw','Swahili');
							display_checkbox('ta','Tamil');
							display_checkbox('te','Telugu');
							display_checkbox('th','Thai');
							display_checkbox('tr','Turkish');
							display_checkbox('uk','Ukrainian');
							display_checkbox('vi','Vietnamese');
							display_checkbox('zh_CN','Chinese (China)');
							display_checkbox('zh_TW','Chinese (Taiwan)');
						  ?>				
					</div>
				</div>
			</form>			
		</div>	
		

<?php } ?>		
		
<script type="text/javascript">
        function submitForm() {
            console.log("submit event");
            var fd = new FormData(document.getElementById("form2"));
            $.ajax({
              url: "result_app_int.php",
              type: "POST",
              data: fd,
              enctype: 'multipart/form-data',
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {
                console.log("PHP Output:");
                console.log( data );
				$('#info1').html(data);
            });
            return false;
        }
    </script>
		<!-- This is a placeholder fallback for IE9 browser -->
		<!-- For IE9 and below - placeholder fallback-->
		<!--[if lt IE 10]>
			<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
			<script src="icons/jquery.placeholder.min.js"></script>
			<script type="text/javascript">
				$('input, textarea').placeholder();
			</script>
		<![endif]-->
	</body>
</html>