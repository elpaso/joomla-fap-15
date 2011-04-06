<?php
/**
 * $Id: default.php 114 2010-09-30 15:14:33Z elpaso $
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
$cparams =& JComponentHelper::getParams('com_media');
?>

<?php if ( $this->params->get( 'show_page_title' ) ) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>"><h1>
<?php if ($this->category->title) :
    echo $this->escape($this->params->get('page_title')).' - '.$this->escape($this->category->title);
else :
    echo $this->escape($this->params->get('page_title'));
endif; ?>
</h1></div>
<?php endif; ?>
<div class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if ($this->category->image || $this->category->description) : ?>
    <div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
    <?php if ($this->params->get('image') != -1 && $this->params->get('image') != '') : ?>
        <img src="<?php echo $this->baseurl .'/'. $cparams->get('image_path') . '/'. $this->params->get('image'); ?>" align="<?php echo $this->params->get('image_align'); ?>" hspace="6" alt="<?php echo JText::_( 'Contacts' ); ?>" />
    <?php elseif ($this->category->image) : ?>
        <img src="<?php echo $this->baseurl .'/'. $cparams->get('image_path') . '/'. $this->category->image; ?>" align="<?php echo $this->category->image_position; ?>" hspace="6" alt="<?php echo JText::_( 'Contacts' ); ?>" />
    <?php endif; ?>
    <?php echo $this->category->description; ?>
    </div>
<?php endif; ?>
<script type="text/javascript">
    function tableOrdering( order, dir, task ) {
    var form = document.getElementById('adminForm');

    form.filter_order.value     = order;
    form.filter_order_Dir.value = dir;
    form.submit( task );
}
</script>
<form action="<?php echo $this->action; ?>" method="post" id="adminForm">
<table width="100%" border="0" cellspacing="0" cellpadding="0" style="text-align:left">
    <thead>
        <tr>
            <td style="text-align:right" colspan="6">
            <?php if ($this->params->get('show_limit')) :
                echo JText::_('Display Num') .'&nbsp;';
                echo $this->pagination->getLimitBox();
            endif; ?>
            </td>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <td align="center" colspan="6" class="sectiontablefooter<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo $this->pagination->getPagesLinks(); ?>
            </td>
        </tr>
        <tr>
            <td colspan="6" style="text-align:right">
                <?php echo $this->pagination->getPagesCounter(); ?>
            </td>
        </tr>
    </tfoot>
    <tbody>
    <?php if ($this->params->get( 'show_headings' )) : ?>
        <tr>
            <th scope="col" style="width:0.2em;text-align:right" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo JText::_('Num'); ?>
            </th>
            <th scope="col" style="height:1em" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo JHTML::_('grid.sort',  'Name', 'cd.name', $this->lists['order_Dir'], $this->lists['order'] ); ?>
            </th>
            <?php if ( $this->params->get( 'show_position' ) ) : ?>
            <th scope="col" style="height:1em" class="sectiontableheader<?php echo  $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo JHTML::_('grid.sort',  'Position', 'cd.con_position', $this->lists['order_Dir'], $this->lists['order'] ); ?>
            </th>
            <?php endif; ?>
            <?php if ( $this->params->get( 'show_email' ) ) : ?>
            <th scope="col" style="height:1em;width:20%" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo JText::_( 'Email' ); ?>
            </th>
            <?php endif; ?>
            <?php if ( $this->params->get( 'show_telephone' ) ) : ?>
            <th scope="col" style="height:1em;width:15%" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo JText::_( 'Phone' ); ?>
            </th>
            <?php endif; ?>
            <?php if ( $this->params->get( 'show_mobile' ) ) : ?>
            <th scope="col" style="height:1em;width:15%" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                <?php echo JText::_( 'Mobile' ); ?>
            </th>
            <?php endif; ?>
            <?php if ( $this->params->get( 'show_fax' ) ) : ?>
                <th scope="col" style="height:1em;width:15%" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
                    <?php echo JText::_( 'Fax' ); ?>
                </th>
            <?php endif; ?>
        </tr>
    <?php endif; ?>
    <?php echo $this->loadTemplate('items'); ?>
</tbody>
</table>
<div>
<input type="hidden" name="option" value="com_contact" />
<input type="hidden" name="catid" value="<?php echo $this->category->id;?>" />
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="" />
</div>
</form>
</div>
