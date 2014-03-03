{extends $layout}

{block content}

<article id="post-{$post->id}" class="{$post->htmlClasses}">

	<header class="entry-header">

		<h1 class="entry-title">
			<a href="{$post->permalink}" title="Permalink to {$post->title}" rel="bookmark">{$post->title}</a>
			{if $rating}
			<span class="rating">
				{for $i = 1; $i <= $rating['max']; $i++}
					<span class="star{if $i <= $rating['val']} active{/if}"></span>
				{/for}
			</span>
			{/if}
		</h1>

		<div class="category-breadcrumb clearfix">
			<span class="here">{__ 'You are here'}</span>
			<span class="home"><a href="{!$homeUrl}">{__ 'Home'}</a>&nbsp;&nbsp;&gt;</span>
			{foreach $ancestors as $anc}
				{first}<span class="ancestors">{/first}
				<a href="{!$anc->link}">{!$anc->name}</a>&nbsp;&nbsp;&gt;
				{last}</span>{/last}
			{/foreach}
			{ifset $term}<span class="name"><a href="{!$term->link}">{!$term->name}</a></span>{/ifset}
			<span class="title"> >&nbsp;&nbsp;{$post->title}</span>
		</div>

	</header>

	<div class="entry-content clearfix">

		<div class="item-image">

			{if $post->thumbnailSrc}
			<img src="{timthumb src => $post->thumbnailSrc, w => 140, h => 200}" alt="{__ 'Item image'}">
			{/if}

			{if isset($options['emailContactOwner']) && (!empty($options['email']))}
			<a id="contact-owner-button" class="contact-owner button" href="#contact-owner-form-popup">{_ "Contact owner"}</a>
			{/if}

			{if (isset($themeOptions->directory->enableClaimListing)) && (!$hasAlreadyOwner)}
			<a id="claim-listing-button" class="claim-listing-button" href="#claim-listing-form-popup">{_ "Own this business?"}</a>
			{/if}

		</div>

		{if isset($options['emailContactOwner']) && (!empty($options['email']))}
		<!-- contact owner form -->
		<div id="contact-owner-form-popup" style="display:none;">
			<div id="contact-owner-form" data-email="{$options['email']}">

				<h3>{_ "Contact owner"}</h3>

				<div class="input name">
					<input type="text" class="cowner-name" name="cowner-name" value="" placeholder="{_ 'Your name'}">
				</div>
				<div class="input email">
					<input type="text" class="cowner-email" name="cowner-email" value="" placeholder="{_ 'Your email'}">
				</div>
				<div class="input subject">
					<input type="text" class="cowner-subject" name="cowner-subject" value="" placeholder="{_ 'Subject'}">
				</div>
				<div class="input message">
					<textarea class="cowner-message" name="cowner-message" cols="30" rows="4" placeholder="{_ 'Your message'}"></textarea>
				</div>
				<button class="contact-owner-send">{_ "Send message"}</button>

				<div class="messages">
					<div class="success" style="display: none;">{_ "Your message has been successfully sent"}</div>
					<div class="error validator" style="display: none;">{_ "Please fill out email, subject and message"}</div>
					<div class="error server" style="display: none;"></div>
				</div>

			</div>
		</div>
		{/if}

		{if (isset($themeOptions->directory->enableClaimListing)) && (!$hasAlreadyOwner)}
		<!-- claim listing form -->
		<div id="claim-listing-form-popup" style="display:none;">
			<div id="claim-listing-form" data-item-id="{$post->id}">

				<h3>{_ "Enter your claim"}</h3>

				<div class="input name">
					<input type="text" class="claim-name" name="claim-name" value="" placeholder="{_ 'Your name'}">
				</div>
				<div class="input email">
					<input type="text" class="claim-email" name="claim-email" value="" placeholder="{_ 'Your email'}">
				</div>
				<div class="input number">
					<input type="text" class="claim-number" name="claim-number" value="" placeholder="{_ 'Your phone number'}">
				</div>
				<div class="input username">
					<input type="text" class="claim-username" name="claim-username" value="" placeholder="{_ 'Username'}">
				</div>
				<div class="input message">
					<textarea class="claim-message" name="claim-message" cols="30" rows="4" placeholder="{_ 'Your claim message'}"></textarea>
				</div>
				<button class="claim-listing-send">{_ "Submit"}</button>

				<div class="messages">
					<div class="success" style="display: none;">{_ "Your claim has been successfully sent"}</div>
					<div class="error validator" style="display: none;">{_ "Please fill out inputs!"}</div>
					<div class="error server" style="display: none;"></div>
				</div>

			</div>
		</div>
		{/if}

		{!$post->content}

	</div>

	{ifset $themeOptions->directory->showShareButtons}
	<div class="item-share">
		<!-- facebook -->
		<div class="social-item fb">
			<iframe src="//www.facebook.com/plugins/like.php?href={$post->permalink}&amp;send=false&amp;layout=button_count&amp;width=113&amp;show_faces=true&amp;font&amp;colorscheme=light&amp;action=like&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:113px; height:21px;" allowTransparency="true"></iframe>
		</div>
		<!-- twitter -->
		<div class="social-item">
			<a href="https://twitter.com/share" class="twitter-share-button" data-url="{$post->permalink}" data-text="{$themeOptions->directory->shareText} {$post->permalink}" data-lang="en">Tweet</a>
			<script>!function(d,s,id){ var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){ js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		<!-- google plus -->
		<!-- Place this tag where you want the +1 button to render. -->
		<div class="social-item">
			<div class="g-plusone"></div>
			<!-- Place this tag after the last +1 button tag. -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</div>

	</div>
	{/ifset}

	<hr>
	<div class="item-info">

		{if (!empty($options['address'])) || (!empty($options['gpsLatitude'])) || (!empty($options['telephone'])) || (!empty($options['email'])) || (!empty($options['web']))}
		<dl class="item-address">

			<dt class="title"><h4>{__ 'Address'}</h4></dt>

			{if (!empty($options['address']))}
			<dt class="address">{__ 'Address:'}</dt>
			<dd class="data">{!$options['address']}</dd>
			{/if}

			{if (!empty($options['gpsLatitude']))}
			<dt class="gps">{__ 'GPS:'}</dt>
			<dd class="data">{$options['gpsLatitude']}, {$options['gpsLongitude']}</dd>
			{/if}

			{if (!empty($options['telephone']))}
			<dt class="phone">{__ 'Telephone:'}</dt>
			<dd class="data">{$options['telephone']}</dd>
			{/if}

			{if (!empty($options['email']))}
			<dt class="email">{__ 'Email:'} </dt>
			<dd class="data"><a href="mailto:{!$options['email']}">{!$options['email']}</a></dd>
			{/if}

			{if (!empty($options['web']))}
			<dt class="web">{__ 'Web:'} </dt>
			<dd class="data"><a href="{!$options['web']}">{!$options['web']}</a></dd>
			{/if}

		</dl>
		{/if}

		{if (!empty($options['hoursAlternative'])) || (!empty($options['hoursMonday'])) || (!empty($options['hoursTuesday'])) || (!empty($options['hoursWednesday'])) || (!empty($options['hoursThursday'])) || (!empty($options['hoursFriday'])) || (!empty($options['hoursSaturday'])) || (!empty($options['hoursSunday']))}
		<dl class="item-hours">

			<dt class="title">
				<h4>{__ 'Opening Hours'}
<?php	
$currentday = date('D');

$hours_monday = $options['hoursMonday'];
$hours_tuesday = $options['hoursTuesday'];
$hours_wednesday = $options['hoursWednesday'];
$hours_thursday = $options['hoursThursday'];
$hours_friday = $options['hoursFriday'];
$hours_saturday = $options['hoursSaturday'];
$hours_sunday = $options['hoursSunday'];


function check_hours( $open_hours ) {
	$explode_hours = explode(" ", $open_hours);
	$blnBoolean = true;
	//$hour_close = 2;
	foreach ($explode_hours as $key) {
		
		if ($blnBoolean) {
			
			if ((is_numeric($key[0]) && is_numeric($key[1]) && $key[2] == ":")|| (is_numeric($key[0]) && $key[1] == ":")) {


				if (is_numeric($key[0]) && is_numeric($key[1]) ) {
				  $hour_open = substr($key , 0, 2);
				} else {
				    $hour_open = $key[0];	
				}
				if (($hour_open >= 1 && $hour_open < 12) && $explode_hours[1] === 'pm') {
					// If open is after noon
					$hour_open = $hour_open + 12;
				}
			}
			$blnBoolean = false;
			
		} else {
		
			if ((is_numeric($key[0]) && is_numeric($key[1]) && $key[2] == ":")|| (is_numeric($key[0]) && $key[1] == ":")){
				
				$hour_close = substr($key , 0, 2);;
				if (is_numeric($key[0]) && is_numeric($key[1]) ) {
				  $hour_close = substr($key , 0, 2);
				} else {
				    $hour_close = $key[0];	
				}
				
				if ( ($hour_close >= 1 && $hour_close <= 12) && $explode_hours[4] === 'pm' ) {
					// If close is before midnight
					$hour_close = $hour_close + 12;
				} elseif ( ($hour_close >= 1 && $hour_close <= 5) && $explode_hours[4] === 'am' ) {
					// In case it's past midnight
					$hour_close = $hour_close + 24;
				} elseif ( ($hour_close == 12) && $explode_hours[4] === 'am' ) {
					// In case it's past midnight
					$hour_close = 24;
				}
				
			}
		}
	}
	
	check_open_close($hour_open, $hour_close);
	
}

function check_open_close($open_time, $close_time) {
	$current_time = date( 'H', current_time( 'timestamp', 0 ) );
	//echo $current_time . "current time";
	//echo $open_time . "open time";
	//echo $close_time . "close time";
	if( $open_time <= $current_time && $close_time > $current_time ) {
		// Yay it's open!
		$is_open = 'Open';
	} else {
		$is_open = 'Closed';
	}
	
	echo '<div class="open-close-button ' . $is_open . '">' . $is_open . '</div>';
}


if( isset( $options['hoursMonday'] ) && ( $currentday == 'Mon' ) ) {
	check_hours($hours_monday);
} elseif( isset( $options['hoursTuesday'] ) && ( $currentday == 'Tue' ) ) {
	check_hours($hours_tuesday);
} elseif( isset( $options['hoursWednesday'] ) && ( $currentday == 'Wed' ) ) {
	check_hours($hours_wednesday);
} elseif( isset( $options['hoursThursday'] ) && ( $currentday == 'Thu' ) ) {
	check_hours($hours_thursday);
} elseif( isset( $options['hoursFriday'] ) && ( $currentday == 'Fri' ) ) {
	check_hours($hours_friday);
} elseif( isset( $options['hoursSaturday'] ) && ( $currentday == 'Sat' ) ) {
	check_hours($hours_saturday);
} elseif( isset( $options['hoursSunday'] ) && ( $currentday == 'Sun' ) ) {
	check_hours($hours_sunday);
}

?>
			</h4></dt>



		    {if (!empty($options['hoursAlternative']))}
		    <dt class="day">{__ 'Alternative Hours:'}</dt>
		    <dd class="data">{!$options['hoursAlternative']}</dd>
		    {/if}

		    {if (!empty($options['hoursMonday']))}
		    <dt class="day">{__ 'Monday:'}</dt>
		    <dd class="data">{!$options['hoursMonday']}</dd>
		    {/if}

		    {if (!empty($options['hoursTuesday']))}
		    <dt class="day">{__ 'Tuesday:'}</dt>
		    <dd class="data">{!$options['hoursTuesday']}</dd>
		    {/if}

		    {if (!empty($options['hoursWednesday']))}
		    <dt class="day">{__ 'Wednesday:'}</dt>
		    <dd class="data">{!$options['hoursWednesday']}</dd>
		    {/if}

		    {if (!empty($options['hoursThursday']))}
		    <dt class="day">{__ 'Thursday:'}</dt>
		    <dd class="data">{!$options['hoursThursday']}</dd>
		    {/if}

		    {if (!empty($options['hoursFriday']))}
		    <dt class="day">{__ 'Friday:'}</dt>
		    <dd class="data">{!$options['hoursFriday']}</dd>
		    {/if}

		    {if (!empty($options['hoursSaturday']))}
		    <dt class="day">{__ 'Saturday:'}</dt>
		    <dd class="data">{!$options['hoursSaturday']}</dd>
		    {/if}

		    {if (!empty($options['hoursSunday']))}
		    <dt class="day">{__ 'Sunday:'}</dt>
		    <dd class="data">{!$options['hoursSunday']}</dd>
		    {/if}

		</dl>
		{/if}

     {if (!empty($options['twitterHandle'])) || (!empty($options['facebookPage']))}     
		<dl class="item-title">

			<dt class="title"><h4>{__ 'Social'}</h4></dt> 
			
			{if (!empty($options['twitterHandle']))}
		    <dt class="sub-title">{__ 'Twitter:'}</dt>
		    <dd class="data"><a href="http://twitter.com/{!$options['twitterHandle']}">{!$options['twitterHandle']}</a></dd>
		    {/if}
		    
		    {if (!empty($options['facebookPage']))}
		    <dt class="sub-title">{__ 'Facebook:'}</dt>
		    <dd class="data"><a href="{!$options['facebookPage']}">{!$options['facebookPage']}</a></dd>
		    {/if}

		</dl>
		{/if}

        {if $options['ChildFriendly'] || $options['PetFriendly'] || $options['LightFare'] || $options['Restaurant'] || $options['BusRVParking'] || $options['Tours'] || $options['PicnicArea'] || $options['Events'] || $options['Weddings'] || $options['ReservationRequired'] || $options['TastingRoom'] || $options['TastingFee'] || $options['WineClub'] || $options['Groups'] || $options['PrivateParties']}     
        <dl class="item-title">
            <dt class="title"><h4>{__ 'Features'}</h4></dt> 
                
            {if $options['ChildFriendly']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Child-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Child Friendly" />Child Friendly</dd>
            {/if}
                
            {if $options['PetFriendly']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Pet-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Pet Friendly" />Pet Friendly</dd>
            {/if}
                 
            {if $options['LightFare']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Light-Fare-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Light Fare" />Light Fare</dd>
            {/if}
                
            {if $options['Restaurant']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Restaurant-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Restaurant" />Restaurant</dd>
            {/if}    
                
            {if $options['BusRVParking']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Bus-RV-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Bus/RV Parking" />Bus/RV Parking</dd>
            {/if}
                
            {if $options['Tours']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Tours-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Tours" />Tours</dd>
            {/if}
 
            {if $options['PicnicArea']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Picnic-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Picnic Area" />Picnic Area</dd>
            {/if}
                
            {if $options['Events']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Events-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Events" />Events</dd>
            {/if}
                 
            {if $options['Weddings']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Weddings-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Weddings" />Weddings</dd>
            {/if}
                
            {if $options['ReservationRequired']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Reservations-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Reservation Required" />Reservation Required</dd>
            {/if}    
                
            {if $options['TastingRoom']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Tasting-Room-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Tasting Room" />Tasting Room</dd>
            {/if}
 
            {if $options['TastingFee']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Tasting-Fee-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Tasting Fee" />Tasting Fee</dd>
            {/if}
                 
            {if $options['WineClub']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Wine-Club-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Wine Club" />Wine Club</dd>
            {/if}
                
            {if $options['Groups']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Groups-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Groups" />Groups</dd>
            {/if}
                
            {if $options['PrivateParties']}
            <dd><img src="http://visitgeorgiawineries.com/wp-content/uploads/2013/10/Parties-35.png" style="width:20px; height:20px; margin:5px; vertical-align:middle" alt="Private Parties" />Private Parties</dd>
            {/if}
        </dl>
        {/if}

		<!-- Custom Styles-->
		<style type="text/css">
		.item-title { padding: 0 0 20px 50px; }
		.item-title .sub-title { float: left; font-weight: bold; width: 80px; }
		</style>

	</div>

	<div class="item-map clearfix">
	</div>

	<hr>

	{if (!empty($options['alternativeContent']))}
	<div class="item-alternative-content">
		{!do_shortcode($options['alternativeContent'])}
	</div>
	{/if}

</article><!-- /#post-{$post->id} -->

{ifset $themeOptions->rating->enableRating}
	{!getAitRatingElement($post->id)}
{/ifset}

{include comments-dir.php, closeable => (isset($themeOptions->general->closeComments)) ? true : false, defaultState => $themeOptions->general->defaultPosition}

{ifset $themeOptions->advertising->showBox4}
<div id="advertising-box-4" class="advertising-box">
    {!$themeOptions->advertising->box4Content}
</div>
{/ifset}

{/block}