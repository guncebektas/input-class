<?php
class Input
{
	public static $start;
	public static $finish;
	
	public static $required = false;
	public static $disabled = false;
	public static $checked = '';
	public static $default = true;
	// label of element
	public static $label = false;
	// id value of element
	public static $id = false;
	// name value of element
	public static $name = false;
	// warning note after element
	public static $note = false;
	
	public static $container = true;
	public static $only_element = false;
	
	// variables for map
	public static $lat = '41.001897';
	public static $lng = '28.583706';
	public static $zoom = 9;
	
	public function __construct()
	{
		if (self::$container)
			self::$start = '	<div class="formRow">';	
	}
	public function __destruct()
	{
		if (self::$container)
		{
			self::$finish .= '	<div class="clear"></div>    
							</div>';	
		}
		self::$name = false;
		self::$note = false;
	}
	// type="text"
	public static function text($name, $data = '')
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		if (self::$disabled)
			self::$disabled = 'disabled';
			
		$result = '	<div class="grid2">
						<label>'.__($label).'</label>
					</div>
					<div class="grid10">
						<input type="text" name="'.$_name.'" id="'.$name.'" value="'.$data.'" class="'.self::$required.'" '.self::$disabled.'>
						<span class="note">'. __(self::$note) .'</span>
					</div>';
					
		return self::$start.$result.self::$finish;
	} 
	// type="password"
	public static function pass($name)
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
	    	
		$result = ' <div class="grid2">
						<label>'.__($label).'</label>
					</div>
					<div class="grid10">
						<input type="password" name="'.$name.'" id="'.$name.'" class="'.self::$required.'">
						<span class="note">'. __(self::$note) .'</span>
					</div>';
						
		return self::$start.$result.self::$finish;
	} 
	// type="file"
	public static function browse($name)
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		$result = '	<div class="grid2">
						<label>'.__($label).'</label>
					</div>
					<div class="grid10">
						<input type="file" name="'.$_name.'" id="'.$name.'" class="'.self::$required.'">
						<span class="note">'. __(self::$note) .'</span>
					</div>';
		
		return self::$start.$result.self::$finish;
	} 
	// ckfinder
	public static function finder($name, $data = '')
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		?>
		<script type="text/javascript">
		// CK editör
		function BrowseServer(startupPath, functionData)
		{
			// You can use the "CKFinder" class to render CKFinder in a page:
			var finder = new CKFinder();
			// The path for the installation of CKFinder (default = "/ckfinder/").
			finder.basePath = '../';
			//Startup path in a form: "Type:/path/to/directory/"
			finder.startupPath = startupPath;
			// Name of a function which is called when a file is selected in CKFinder.
			finder.selectActionFunction = SetFileField;
			// Additional data to be passed to the selectActionFunction in a second argument.
			// We'll use this feature to pass the Id of a field that will be updated.
			finder.selectActionData = functionData;
			// Name of a function which is called when a thumbnail is selected in CKFinder.
			finder.selectThumbnailActionFunction = ShowThumbnails;
			// Launch CKFinder
			finder.popup();
		}
		// This is a sample function which is called when a file is selected in CKFinder.
		function SetFileField(fileUrl, data)
		{
			var sFileName = this.getSelectedFile().name;
			var sFileFolder = this.getSelectedFile().folder;
			text = sFileFolder+sFileName;
			text = text.substr(1);
			
			document.getElementById(data["selectActionData"] ).value = text;
		}
		// This is a sample function which is called when a thumbnail is selected in CKFinder.
		function ShowThumbnails(fileUrl, data)
		{
			// this = CKFinderAPI
			var sFileName = this.getSelectedFile().name;
			document.getElementById( 'thumbnails' ).innerHTML +=
					'<div class="thumb">' +
						'<img src="' + fileUrl + '" />' +
						'<div class="caption">' +
							'<a href="' + data["fileUrl"] + '" target="_blank">' + sFileName + '</a> (' + data["fileSize"] + 'KB)' +
						'</div>' +
					'</div>';
			document.getElementById( 'preview' ).style.display = "";
			// It is not required to return any value.
			// When false is returned, CKFinder will not close automatically.
			return false;
		}
		</script>
		<?php
		$result = '	<div class="grid2">
	    				<label>'.__($label).'</label>
	    			</div>
                    <div class="grid10">
                    	<div class="grid1">
                        	<a class="buttonS bBlack first" onclick="BrowseServer( \'Images:/\', \''.$name.'\' );">'.__('Select').'</a>
                        </div> 
                        <div class="grid9">
                        	<input id="'.$name.'" name="'.$_name.'" type="text" size="60" value="'.$data.'" class="'.self::$required.'"/>
                        	<span class="note">'. __(self::$note) .'</span>
						</div>
						<div class="grid2">
                        	<a class="buttonS bRed" onclick="clean(\''.$name.'\')">'. __('Do_not_use_image').'</a>
                        </div>
                    </div>';
		
		return self::$start.$result.self::$finish;
	} 
	public static function check($name, $value, $text)
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$checked)
			self::$checked = 'checked="checked"';
			
		if (self::$disabled)
			self::$disabled = 'disabled';
		
		if (self::$label == '-1')
		{
			$result = '	<div class="grid12 check">
				            <input type="checkbox" '.self::$checked.' name="'.$name.'" value="'.$value.'"/>
				            <label for="check1"  class="mr20">'.$text.'</label>
				            <span class="note">'. __(self::$note) .'</span>
				        </div>';
		}
		else
		{
			$result = '	<div class="grid2"><label>'.$label.'</label></div>
				        <div class="grid10 check">
				            <input type="checkbox" '.self::$checked.' name="'.$name.'" value="'.$value.'"/>
				            <label for="check1"  class="mr20">'.$text.'</label>
				            <span class="note">'. __(self::$note) .'</span>
				        </div>';
		}

		return self::$start.$result.self::$finish;			
	}
	// Select box
	public static function select($name, $data, $selected_id = '')
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$id)
			$id = self::$id;
		else
	    	$id = $name;
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$disabled)
			self::$disabled = 'disabled';
		
		if (self::$only_element)
		{
			$result = '	<select class="'.self::$required.' '.$name.'" id="'.$id.'" name="'.$name.'" '.self::$disabled.' style="width:350px;">';
	                        if (self::$default)
	                        	$result .= ' <option value="0">'.__('None').'</option>'; 
							
							for ($i=0; $i<count($data); $i++)
							{
								if ($data[$i]['id'] == $selected_id)
									$selected = 'selected';
								else
									$selected = '';
									
								$result .= ' <option '.$selected.' value="'.$data[$i]['id'].'">'.$data[$i]['value'].'</option>'; 
	                     	}
			$result .= '	</select>';
					
			return $result;
        }
		$result = '	<div class="grid2">
	    				<label>'.__($label).'</label>
	    			</div>
                    <div class="grid10 searchDrop">
                        <select data-placeholder="'.__('Select').'" class="select '.self::$required.'" id="'.$id.'" name="'.$name.'" '.self::$disabled.' style="width:350px;" tabindex="2">';
                            if (self::$default)
                            	$result .= ' <option value="0">'.__('None').'</option>'; 
							
							for ($i=0; $i<count($data); $i++)
							{
								if ($data[$i]['id'] == $selected_id)
									$selected = 'selected';
								else
									$selected = '';
									
								$result .= ' <option '.$selected.' value="'.$data[$i]['id'].'">'.$data[$i]['value'].'</option>'; 
                         	}
							
                         $result .= '   
                        </select>
                        <span class="note">'. __(self::$note) .'</span>
                    </div>';
	
		return self::$start.$result.self::$finish;
	}

	public static function textarea($name, $data = '')
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		if (self::$disabled)
			self::$disabled = 'disabled';
		
		$result = ' <div class="grid2">
						<label>'.__($label).'</label>
					</div>
					<div class="grid10">
						<textarea name="'.$_name.'" id="'.$name.'" class="'.self::$required.'" '.self::$disabled.'>'.$data.'</textarea>
						<span class="note">'. __(self::$note) .'</span>
					</div>';
						
		return self::$start.$result.self::$finish;
	} 
	public static function editor($name, $data = '')
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		require_once('ckeditor/ckupload.php');
	    $result = '	<div class="grid2">
	    				<label>'.__($label).'</label>
	    			</div>
	    			<div class="grid10">
	    				<textarea class="ckeditor '.self::$required.'" id="ckeditor" name="'.$_name.'" rows="10" cols="80">'.$data.'</textarea>
	    				<span class="note">'. __(self::$note) .'</span>
	    			</div>';
						
		return self::$start.$result.self::$finish;
	} 
	public static function img($name, $data)
	{
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		$result = '	<div class="grid2">
	    				<label>'.__($label).'</label>
	    			</div>
	    			<div class="grid10">
	    				<img src="'.$data.'" name="'.$name.'" id="'.$name.'">
	    				<span class="note">'. __(self::$note) .'</span>
	    			</div>';
		
		return self::$start.$result.self::$finish;
	}
	public static function map($name)
	{
		if (self::$required)
			self::$required = 'required';
		
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		?>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=tr"></script>
		<script type="text/javascript">
		var map;
		var marker;
		var geocoder;
		function initialize() 
		{
			geocoder = new google.maps.Geocoder();
			var latlng = new google.maps.LatLng($('#<?php echo $name;?>_lat').val() , $('#<?php echo $name;?>_lng').val());
			var myOptions = {
				zoom: <?php echo self::$zoom; ?>,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
			
			marker = new google.maps.Marker({
				position: latlng,
				map: map,
				icon: '<?php echo Routes::$base.'core/img/marker.png'; ?>'
			});
			
			google.maps.event.addListener(marker, 'dragend', function() {
				var pos=marker.getPosition();
				document.getElementById('<?php echo $name;?>_lat').value=pos.lat().toFixed(7);
				document.getElementById('<?php echo $name;?>_lng').value=pos.lng().toFixed(7);
			});
			// To add the marker to the map, call setMap();
			marker.setMap(map);
			marker.setDraggable(true);
		}
		
		$(document).ready(function()
		{
			initialize();
		});
		</script>
		<?php
		$result = '	<div class="grid2">
	    				<label>'.__($label).'</label>
	    			</div>
	    		    <div class="grid10">
                    	<input type="hidden" id="'.$name.'_lat" name="'.$name.'_lat" placeholder="" value="'.self::$lat.'" class="'.self::$required.'">
                    	<input type="hidden" id="'.$name.'_lng" name="'.$name.'_lng" placeholder="" value="'.self::$lng.'" class="'.self::$required.'">
                		<div id="map_canvas" style="height: 400px; width: 100%;"></div>
                		<span class="note">'. __(self::$note) .'</span>
                    </div>';
						
		return self::$start.$result.self::$finish;
	}	

	public static function date($name, $data = 0)
	{
		global $site;
		
		if (self::$id)
			$id = self::$id;
		else
	    	$id = $name;
		
		if (empty($data))
			$data = $site['timestamp'];
		
		if (!is_numeric($data))
			$expire = date('Y-m-d', strtotime($data));
		else
			$expire = date('Y-m-d', $data);
		
		?>
		<script type="text/javascript">
		$(function() {
			$('#inlinedate_<?php echo $id; ?>').datepicker({
		        inline: true,
				showOtherMonths:true,
				onSelect: function(dateText, inst) {
					$(".inlinedate_<?php echo $id; ?>_value").val(dateText.substring(0, dateText.length-3));
				},
				defaultDate: '<?php echo $data; ?>000',
				dateFormat: '@'
		    });
		 });
		</script>
		<?php
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		if (self::$only_element)
			return '<div id="inlinedate_'.$name.'"></div>
					<input type="hidden" class="inlinedate_'.$name.'_value" size="10" id="'.$id.'" name="'.$_name.'" value="'.$data.'"/>';
			
		$result = '	<div class="grid2">
                    	<label>'.__($label).'</label>
                    </div>
                    <div class="grid9">
                    	<div id="inlinedate_'.$id.'"></div>
                    	<input type="hidden" class="inlinedate_'.$id.'_value" size="10" id="'.$id.'" name="'.$_name.'" value="'.$data.'"/>
                    	<span class="note">'. __(self::$note) .'</span>
                    </div>
                    <div class="clear"></div>';
		
		return self::$start.$result.self::$finish;
	}				
	public static function time($name)
	{
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		
		$result = '	<div class="grid2">
						<label>'.__($label).'</label>
					</div>
					<div class="grid10">
                    	<input type="text" class="timepicker" size="10" id="'.$name.'" name="'.$_name.'" value="'.date('H:i:g', time()).'"/>
                    	<span class="note">'. __(self::$note) .'</span>
                    </div>';
					
		return self::$start.$result.self::$finish;
	} 	
	public static function color($name, $data = '#e62e90')
	{
		if (self::$label)
			$label = self::$label;
		else
	    	$label = $name;
		
		if (self::$name)
			$_name = self::$name;
		else
			$_name = $name;
		?>
		<script type="text/javascript">
		$(function() {
			$('.cPicker_<?php echo $name; ?>').ColorPicker({
				color: '<?php echo $data;?>',
				onShow: function (colpkr) {
					$(colpkr).fadeIn(500);
					return false;
				},
				onHide: function (colpkr) {
					$(colpkr).fadeOut(500);
					return false;
				},
				onChange: function (hsb, hex, rgb) {
					$('.cPicker_<?php echo $name; ?> div').css('backgroundColor', '#' + hex);
					$('#color_<?php echo $name; ?>').val(hex);
				}
			});
		});
		</script>
		<?php
		$result = '	<div class="grid2">
						<label>'.__($label).'</label>
					</div>
					<div class="grid10">
                    	<div class="cPicker_'.$name.'" id="cPicker">
                    		<div style="background-color: '.$data.'"></div>
                    		<input type="hidden" size="10" id="color_'.$name.'" name="'.$_name.'"/>
                    		<span class="note">'. __(self::$note) .'</span>
                    	</div>
                    </div>';
					
		return self::$start.$result.self::$finish;
	} 	
	public static function hidden($name, $data = '')
	{
		if (self::$required)
			self::$required = 'required';
		
		$result = '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$data.'" class="'.self::$required.'">';
					
		return $result;
	} 
}