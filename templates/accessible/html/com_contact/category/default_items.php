<?php
/** $Id: default_items.php 86 2009-01-27 17:54:16Z elpaso $ */
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<?php foreach($this->items as $item) : ?>
<tr>
	<td style="text-align:right;width:0.5em" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->count +1; ?>
	</td>
	<td style="height:1em" class="sectiontableentry<?php echo $item->odd; ?>">
		<a href="<?php echo $item->link; ?>" class="category<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
			<?php echo $item->name; ?></a>
	</td>
	<?php if ( $this->params->get( 'show_position' ) ) : ?>
	<td class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->con_position; ?>
	</td>
	<?php endif; ?>
	<?php if ( $this->params->get( 'show_email' ) ) : ?>
	<td style="width:20%" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->email_to; ?>
	</td>
	<?php endif; ?>
	<?php if ( $this->params->get( 'show_telephone' ) ) : ?>
	<td style="width:15%" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->telephone; ?>
	</td>
	<?php endif; ?>
	<?php if ( $this->params->get( 'show_mobile' ) ) : ?>
	<td style="width:15%" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->mobile; ?>
	</td>
	<?php endif; ?>
	<?php if ( $this->params->get( 'show_fax' ) ) : ?>
	<td style="width:15%" class="sectiontableentry<?php echo $item->odd; ?>">
		<?php echo $item->fax; ?>
	</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
