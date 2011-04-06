<?php // no direct access
      defined('_JEXEC') or die('Restricted access'); ?>
<form action="<?php echo htmlentities($this->action); ?>" method="post" id="adminForm">
    <?php if ($this->params->get('filter') || $this->params->get('show_pagination_limit')) : ?>
    <div>
        <?php if ($this->params->get('filter')) : ?>
            <label for="filter"><?php echo JText::_('Filter').'&#160;'; ?></label>
            <input type="text" id="filter" name="filter" value="<?php echo $this->escape($this->lists['filter']);?>" class="inputbox" onchange="document.adminForm.submit();" />
        <?php endif; ?>
        <?php if ($this->params->get('show_pagination_limit')) {
            echo '<label for="limit">'.'&#160;&#160;&#160;'.JText::_('Display Num').'&#160;'.'</label>';
            echo $this->pagination->getLimitBox();
        } ?>
    </div>
    <?php endif; ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <?php if ($this->params->get('show_headings')) : ?>
    <thead>
        <tr>
        <th scope="col" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>" style="text-align:right;width:5%">
            <?php echo JText::_('Num'); ?>
        </th>
        <?php if ($this->params->get('show_title')) : ?>
        <th scope="col" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>" style="width:45%">
            <?php echo JHTML::_('grid.sort',  'Item Title', 'a.title', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php endif; ?>
        <?php if ($this->params->get('show_date')) : ?>
        <th scope="col" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>" style="width:25%">
            <?php echo JHTML::_('grid.sort',  'Date', 'a.created', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php endif; ?>
        <?php if ($this->params->get('show_author')) : ?>
        <th scope="col" class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>"  style="width:20%">
            <?php echo JHTML::_('grid.sort',  'Author', 'author', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php endif; ?>
        <?php if ($this->params->get('show_hits')) : ?>
        <th class="sectiontableheader<?php echo $this->params->get( 'pageclass_sfx' ); ?>" style="width:5%;white-space:nowrap;text-align:center;">
            <?php echo JHTML::_('grid.sort',  'Hits', 'a.hits', $this->lists['order_Dir'], $this->lists['order'] ); ?>
        </th>
        <?php endif; ?>
    </tr>
    </thead>
    <?php endif; ?>
    <?php foreach ($this->items as $item) : ?>
    <tr class="sectiontableentry<?php echo ($item->odd +1 ) . $this->params->get( 'pageclass_sfx' ); ?>" >
      <td style="text-align:right">
        <?php echo $this->pagination->getRowOffset( $item->count ); ?>
      </td>
      <?php if ($this->params->get('show_title')) : ?>
      <?php if ($item->access <= $this->user->get('aid', 0)) : ?>
        <td>
          <a href="<?php echo $item->link; ?>">
            <?php echo $item->title; ?></a>
          <?php $this->item = $item; echo JHTML::_('icon.edit', $item, $this->params, $this->access) ?>
        </td>
        <?php else : ?>
        <td>
          <?php
               echo $this->escape($item->title).' : ';
          $link = JRoute::_('index.php?option=com_user&task=register', true);
          ?>
          <a href="<?php echo $link; ?>">
            <?php echo JText::_( 'Register to read more...' ); ?></a>
        </td>
        <?php endif; ?>
        <?php endif; ?>
        <?php if ($this->params->get('show_date')) : ?>
        <td>
          <?php echo $item->created; ?>
        </td>
        <?php endif; ?>
        <?php if ($this->params->get('show_author')) : ?>
        <td >
          <?php echo $item->created_by_alias ? $item->created_by_alias : $item->author; ?>
        </td>
        <?php endif; ?>
        <?php if ($this->params->get('show_hits')) : ?>
        <td  style="text-align:center">
          <?php echo $item->hits ? $item->hits : '-'; ?>
        </td>
        <?php endif; ?>
      </tr>
      <?php endforeach; ?>
      <?php if ($this->params->get('show_pagination')) : ?>
      <tr>
        <td colspan="5">&#160;</td>
      </tr>
      <tr>
        <td style="text-align:center" colspan="4" class="sectiontablefooter<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
          <?php echo $this->pagination->getPagesLinks(); ?>
        </td>
      </tr>
      <tr>
        <td colspan="5" style="text-align:right">
          <?php echo $this->pagination->getPagesCounter(); ?>
        </td>
      </tr>
      <?php endif; ?>
    </table>

    <div><input type="hidden" name="id" value="<?php echo $this->category->id; ?>" />
      <input type="hidden" name="sectionid" value="<?php echo $this->category->sectionid; ?>" />
      <input type="hidden" name="task" value="<?php echo $this->lists['task']; ?>" />
      <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
      <input type="hidden" name="filter_order_Dir" value="" /></div>
  </form>
  <script type="text/javascript">
	/* <![CDATA[ */

		// ABP: XHTML fix
		document.adminForm = document.getElementById('adminForm');

		function tableOrdering( order, dir, task )
		{
		var form = document.adminForm;

		form.filter_order.value     = order;
		form.filter_order_Dir.value = dir;
		document.adminForm.submit( task );
		}
	/* ]]> */
  </script>