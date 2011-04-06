<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>
<br />
<table class="pollstableborder" cellspacing="0" cellpadding="0" border="0">
<thead>
	<tr>
		<th colspan="3" class="sectiontableheader">
			<img src="<?php echo $this->baseurl; ?>/components/com_poll/assets/poll.png" width="12" height="14" alt="" style="align: middle; border: 0px;"/>
      <?php echo $this->poll->title; ?>
		</th>
	</tr>
</thead>
<tbody>
<?php foreach($this->votes as $vote) : ?>
	<tr class="sectiontableentry<?php echo $vote->odd; ?>">		
    <td colspan="3" style="width: 100%;">
			<?php echo $vote->text; ?>
		</td>
	</tr>
	<tr class="sectiontableentry<?php echo $vote->odd; ?>">		
    <td align="right" style="width: 25px;">
			<strong><?php echo $vote->hits; ?></strong>&nbsp;
		</td>		
    <td style="width: 30px;" >
			<?php echo $vote->percent; ?>%
		</td>		
    <td style="width: 300px;">
			<div class="<?php echo $vote->class; ?>" style="height:<?php echo $vote->barheight; ?>px;width:<?php echo $vote->percent; ?>%"></div>
		</td>
	</tr>
<?php endforeach; ?>
</tbody>
</table>
<br />
<table cellspacing="0" cellpadding="0" border="0">
<tbody>
	<tr>
		<td class="smalldark">
			<?php echo JText::_( 'Number of Voters' ); ?>
		</td>
		<td class="smalldark">
			&nbsp;:&nbsp;
			<?php if(isset($this->votes[0])) echo $this->votes[0]->voters; ?>
		</td>
	</tr>
	<tr>
		<td class="smalldark">
			<?php echo JText::_( 'First Vote' ); ?>
		</td>
		<td class="smalldark">
			&nbsp;:&nbsp;
			<?php echo $this->first_vote; ?>
		</td>
	</tr>
	<tr>
		<td class="smalldark">
			<?php echo JText::_( 'Last Vote' ); ?>
		</td>
		<td class="smalldark">
			&nbsp;:&nbsp;
			<?php echo $this->last_vote; ?>
		</td>
	</tr>
</tbody>
</table>