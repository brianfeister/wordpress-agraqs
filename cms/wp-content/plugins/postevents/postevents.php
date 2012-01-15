<?php
/*
Plugin Name: Upcoming Events by DreamStar Studios
Plugin URI: http://dreamstarstudios.com
Description: A simple post-driven events plugin.
Version: 0.01
Author: Brian Fegter


*/

//Set Default Timezone
date_default_timezone_set('America/New_York');

//Add Meta Box to Post Edit Page
add_action('admin_menu', 'date_meta');

function date_meta() {
    global $key;
    add_meta_box( 'new-meta-boxes', 'Event Information', 'display_date_meta', 'post', 'normal', 'high' );
    add_action( 'save_post', 'save_date_meta' );
    
    //Uncomment for Page Event Support
    //add_meta_box( 'new-meta-boxes', 'Event Information', 'display_date_meta', 'page', 'normal', 'high' );
    //add_action( 'save_page', 'save_date_meta' );
}

function display_date_meta() {
    global $post;
    $start_date = get_post_meta($post->ID, '_date_start', true);
    if($start_date):$start = date('m-d-Y', $start_date); else: $start = '';endif;
    $end_date = get_post_meta($post->ID, '_date_end', true);
    if($end_date):$end = date('m-d-Y', $end_date); else: $end = '';endif;
    $description = get_post_meta($post->ID, '_date_description', true);
    $location = get_post_meta($post->ID, '_date_location', true);
    $address = get_post_meta($post->ID, '_date_address', true);
    $tag = get_post_meta($post->ID, '_date_tag', true);
    if($start_date):
        $the_minute = date('i', $start_date);
        $the_hour = date('h', $start_date);
        $the_am_pm = date('a', $start_date);
    endif;
    if($start_date && $end_date && $start_date > $end_date) echo "<p class='warning'>Your start date cannot be later than your end date.</p>";
    ?>

    <div class="form-wrap">
        
        <div class="form-field">
            <div class="date-field">
                <label for="date_location">Location</label>
                <input type="text" name="_date_location" value="<?=$location?>" />
            </div>
            
            <div class="date-field">
                <label for="date_start">Start Date</label>
                <input type="text" id="startdate" name="_date_start" value="<?=$start?>" />
            </div>
            
            <div class="date-field">
                <label for="date_end">End Date</label>
                <input type="text" id="enddate" name="_date_end" value="<?=$end?>" />
            </div>
            
            <div class="date-field">
                <label for="date_time">Time</label>
                <?php $hours = array(1,2,3,4,5,6,7,8,9,10,11,12);?>
                <select name="_date_hour">
                <?php global $selected;
                foreach($hours as $hour):
                    if($the_hour == $hour):$selected = ' selected="selected"';endif;?>
                        <option value="<?=$hour?>"<?=$selected?>><?=$hour?></option>
                    <?php $selected = '';
                endforeach;?>
                </select>

                <?php $minutes = array('00','05',10,15,20,25,30,35,40,45,50,55);?>
                <select name="_date_minute">
                <?php global $selected;
                foreach($minutes as $minute):
                    if($the_minute == $minute):$selected = ' selected="selected"';endif;?>
                        <option value="<?=$minute?>"<?=$selected?>><?=$minute?></option>
                    <?php $selected = '';
                endforeach;?>
                </select>
                
                <?php $formats = array('am','pm');?>
                <select name="_date_am_pm">
                    <?php foreach($formats as $format):
                        if($the_am_pm == $format) $selected = 'selected="selected"';?>
                            <option value="<?=$format?>"<?=$selected?>><?=strtoupper($format)?></option>
                        <?php $selected = '';
                    endforeach?>
                </select>
            </div>
            
            <div class="date-field">
                <label for="date_address">Address</label>
                <input type="text" name="_date_address" value="<?php echo htmlspecialchars($address); ?>" />
            </div>
            
            <div class="date-field">
                <label for="date_location">Long Date Tagline</label>
                <input type="text" name="_date_tag" value="<?php echo htmlspecialchars($tag); ?>" />
            </div>
            
        </div>
        
    </div>
    <?php
}

function save_date_meta( $post_id ) {
    //Assign Posts to Variables
    $start = $_POST['_date_start'];
    $end = $_POST['_date_end'];
    $hour = (int)$_POST['_date_hour'];
    $format = $_POST['_date_am_pm'];
    $description = $_POST['_date_description'];
    $address = $_POST['_date_address'];
    $tag = $_POST['_date_tag'];
    $location = $_POST['_date_location'];
    
    //Convert to 24 Hour
    if($format == 'pm'):
        $hour = $hour + 12;
    endif;
	if($format == 'am' && $hour == 12):
		$hour = $hour - 12;
	endif;    

    //Parse Start Date
    if($start):
        $start = explode('-', $start);
        $start = mktime($hour, $_POST['_date_minute'], 0, $start[0], $start[1], $start[2]);
        $compare = date('ymd', $start);
    endif;
    
    //Parse End Date
    if($end):
        $end = explode('-', $end);
        $end = mktime($hour, $_POST['_date_minute'], 0, $end[0], $end[1], $end[2]);
        $compare = date('ymd', $end); //Overwrite start date $compare
    endif;
    
    //Check User Permission
    if (!current_user_can('edit_post', $post_id))
    return $post_id;

    //Check if values exist and then update
    if($end):
        update_post_meta( $post_id, '_date_end', $end);
    else:
        if($start)update_post_meta( $post_id, '_date_end', $start);
    endif;
    if($start)update_post_meta( $post_id, '_date_start', $start);
    if($description)update_post_meta( $post_id, '_date_description', $_POST['_date_description']);
    if($location)update_post_meta( $post_id, '_date_location', $_POST['_date_location']);
    if($address)update_post_meta( $post_id, '_date_address', $_POST['_date_address']);
    if($tag)update_post_meta( $post_id, '_date_tag', $_POST['_date_tag']);
    if($compare)update_post_meta( $post_id, '_date_compare', $compare);
}

function datepicker_header(){
    $theme_dir = get_bloginfo('wpurl').'/wp-content/plugins/postevents/js/';?>
       
	    <link rel="stylesheet" type="text/css" href="<?=$theme_dir?>anytime.css" />
	    <link rel="stylesheet" type="text/css" href="<?=$theme_dir?>ui.css" />
	    
	    <script>
	    if(typeof(jQuery)=='undefined'){
	    var loadjQuery = document.createElement("script");
	    loadjQuery.setAttribute("type","text/javascript");
	    loadjQuery.setAttribute("src","http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js");
	    document.getElementsByTagName("head")[0].appendChild(loadjQuery);
		}
		</script>
	    
	    <script src="<?=$theme_dir?>anytime.js" type='text/javascript'></script>
	    
			<script type="text/javascript">
			jQuery( function() {
			    jQuery('#startdate').AnyTime_picker( { format: "%m-%d-%Y", firstDOW: 0, baseYear: '<?=date('Y')?>' } );
			    jQuery('#enddate').AnyTime_picker( { format: "%m-%d-%Y", firstDOW: 0, baseYear: '<?=date('Y')?>' } );
			    });
			</script>
	    
	    <style type="text/css">
	        #startdate,#enddate{width:90px !important; text-align:center; margin:5px 0 0;}
	        p.warning{background:#ff8080; color:#fff; padding:8px; margin:10px 0 !important; font-size:14px !important; width:400px !important; text-align:center;}
	        a.end-date{display:block; margin:10px 0 !important; width:100px;}
	        .date-field{margin:0 0 15px;}
	    </style>
		
<?php }

//Add Scripts to Header
add_action('admin_head', 'datepicker_header');


/* Template Functions */

function event_date($start_or_end, $format, $echo = true){
    global $post;
    $start = get_post_meta($post->ID, '_date_start', true);
    $end = get_post_meta($post->ID, '_date_end', true);

    if($start_or_end == 'start'):
        $date = date($format, $start);
        if($echo): echo $date; else: return $date; endif;
    elseif($start_or_end == 'end'):
        $date = date($format, $end);
        if($echo): echo $date; else: return $date; endif;
    endif;   
}

function event_long_date($tagline = true, $echo = true){
    global $post;
    $start = get_post_meta($post->ID, '_date_start', true);
    $start_month = date('m', $start);
    $start_year = date('Y', $start);
    $end = get_post_meta($post->ID, '_date_end', true);
    $end_month = date('m', $end);
    $end_year = date('Y', $end);
    $tag = get_post_meta($post->ID, '_date_tag', true);
    
    if($start <= $end):
        if($start == $end):
            //Month Day, Year
            $date =  date('M', $start).' '.date('j',$start).', '.date('Y', $start);
        else:
            if($start_year == $end_year):
                if($start_month == $end_month):
                    
                    //Month Day - Day, Year
                    $date = date('M', $start).' '.date('j',$start).' - '.date('j', $end).', '.date('Y', $start);
                else:
                    //Month Day - Month Day, Year
                    $date =  date('M', $start).' '.date('j',$start).' - '.date('M', $end).' '.date('j', $end).', '.date('Y', $start);
                endif;
            else:
                //Month Day, Year - Month Day, Year
                $date =  date('M', $start).' '.date('j',$start).', '.date('Y', $start).' - '.date('M', $end).' '.date('j', $end).', '.date('Y', $end);
            endif;
        endif;
    endif;
    
    if($tagline && $tag): $date .= ' '.$tag; endif;
    
    if($echo): echo $date; else: return $date; endif;
}

function event_location($echo = true){
    global $post;
    $location = get_post_meta($post->ID, '_date_location', true);
    if($echo): echo $location; else: return $location; endif;
}

function event_address($echo = true){
    global $post;
    $address = "http://maps.google.com/maps?q=".urlencode(get_post_meta($post->ID, '_date_address', true));
    if($echo): echo $address; else: return $address; endif;
}
function event_tagline($echo = true){
    global $post;
    $tag = '<span class="tagline">'.get_post_meta($post->ID, '_date_tag', true).'</span> | ';
    if($echo): echo $tag; else: return $tag; endif;
}
function event_map_img($echo = true){
    global $post;
    $address = get_post_meta($post->ID, '_date_address', true);
    if($echo): echo '<img src="'.'http://maps.google.com/maps/api/staticmap?center='.$address.'&zoom=14&size=347x146&maptype=roadmap
&markers=color:blue|label:X|'.$address.'&sensor=false" />';
    else:
        return '<img src="'.'http://maps.google.com/maps/api/staticmap?center='.$address.'&zoom=14&size=347x146&maptype=roadmap
&markers=color:blue|label:X|'.$address.'&sensor=false" />';
    endif;
}

function event_map_thumb($echo = true){
    global $post;
    $address = get_post_meta($post->ID, '_date_address', true);
    if($echo): echo '<img src="'.'http://maps.google.com/maps/api/staticmap?center='.$address.'&zoom=14&size=200x150&maptype=roadmap
&markers=color:blue|label:X|'.$address.'&sensor=false" />';
    else:
        return '<img src="'.'http://maps.google.com/maps/api/staticmap?center='.$address.'&zoom=14&size=200x150&maptype=roadmap
&markers=color:blue|label:X|'.$address.'&sensor=false" />';
    endif;
}

function event_tag($echo = true){
    global $post;
    $tag = get_post_meta($post->ID, '_date_tag', true);
    if($echo): echo $tag; else: return $tag; endif;
}

function event_check(){
    global $post;
    if(get_post_meta($post->ID, '_date_start', true)):
        return true;
    else:
        return false;
    endif;
}

function event_date_range($tagline = true, $echo = true){
    global $post;

    $start = get_post_meta($post->ID, '_date_start', true);
    $start_month = date('m', $start);
    $start_year = date('Y', $start);
    $end = get_post_meta($post->ID, '_date_end', true);
    $end_month = date('m', $end);
    $end_year = date('Y', $end);
    $tag = get_post_meta($post->ID, '_date_tag', true);
    
    if($start <= $end):
        if($start == $end):
            // Date numeral
            $date =  date('j',$start);
        else:
            if($start_year == $end_year):
                if($start_month == $end_month):
                    
                    // Date numeral range
                    $date = '<span class="range">'.date('j',$start).'-'.date('j', $end).'</span>';
	            else:
				
                // Month Day, Year - Month Day, Year
                $date =  date('j',$start);
				endif;
            endif;
        endif;
    endif;
        
    if($echo): echo $date; else: return $date; endif;
}

?>