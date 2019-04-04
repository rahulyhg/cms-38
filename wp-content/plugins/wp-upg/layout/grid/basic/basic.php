<div class="pure-u-1 pure-u-md-1-<?php echo $perrow; ?>" id="upg_<?php echo get_the_ID(); ?>">
<div class="odude_img" align="center">

<?php
if($permalink=="0")
			{
			echo '<img src="'.$image.'" class="pure-img">';
			}
		else
		{
			if($popup=="on")
			{
			
			echo '<a href="'.$preview_large.'" title="'.$thetitle.'" class="'.$preview_type.'" border=0><img src="'.$image.'"></a>';
			
			
			}
			else
			{
			echo '<a href="'.$permalink.'" border=0><img src="'.$image.'"></a>';
			}
		}
?>
<?php echo upg_show_icon_grid(); ?>
</div>
</div>