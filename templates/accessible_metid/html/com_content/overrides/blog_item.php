<?php
/**
* This file is part of
* Joomla! 1.5 FAP
* @package   JoomlaFAP
* @version   $Id:$
* @author    Alessandro Pasotti
* @copyright    Copyright (C) 2008 Alessandro Pasotti http://www.itopen.it
* @license      GNU/AGPL

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as
    published by the Free Software Foundation, either version 3 of the
    License, or (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// ABP: Filters for STANCA law
// Thanks to sali40
if(!function_exists('fix_keypress')){
function fix_keypress($html){
        return preg_replace('|onclick="(.*?)"|mus', 'onclick="\1" onkeypress="\1"', $html) . '&nbsp;';
}
}

// Tag level for item heading
$item_title_level = $this->params->get('show_page_title') ? '2' : '1';

?>
<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all')) : ?>
	<div class="contentpaneopen_edit<?php echo $this->params->get( 'pageclass_sfx' ); ?>" style="float: left;">
		<?php echo JHTML::_('icon.edit', $this->item, $this->params, $this->access); ?>
	</div>
<?php endif; ?>
<div  class="articlewrapper">
<?php if ($this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
<div class="cpotitle contentpaneopen<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php if ($this->params->get('show_title')) : ?>
	<div class="contentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<div>
			<div>
				<?php if ($this->params->get('link_titles') && $this->item->readmore_link != '') : ?>
					<h<?php echo $item_title_level;?>><a href="<?php echo $this->item->readmore_link; ?>" class="contentpagetitle<?php echo $this->params->get( 'pageclass_sfx' ); ?>"><?php echo $this->item->title; ?></a></h<?php echo $item_title_level;?>>
				<?php else : ?>
					<h<?php echo $item_title_level;?>><?php echo $this->item->title; ?></h<?php echo $item_title_level;?>>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php endif; ?>

	<?php if (
       $this->params->get('show_pdf_icon')
       || $this->params->get( 'show_print_icon' )
       || $this->params->get('show_email_icon')
       || $this->params->get('show_email_icon')
       || ($this->params->get('show_author') && ($this->item->author != ""))
       || $this->params->get('show_create_date')
       ) : ?>
	<div class="buttonheading">
        <?php if ( $this->params->get( 'show_pdf_icon' )) : ?>
        <?php echo  fix_keypress(JHTML::_('icon.pdf', $this->item, $this->params, $this->access)); ?>
        <?php endif; ?>

        <?php if ( $this->params->get( 'show_print_icon' )) : ?>
        <?php echo  fix_keypress(JHTML::_('icon.print_popup', $this->item, $this->params, $this->access)); ?>
        <?php endif; ?>

        <?php if ($this->params->get('show_email_icon')) : ?>
        <?php echo fix_keypress(JHTML::_('icon.email', $this->item, $this->params, $this->access)); ?>
        <?php endif; ?>
        <?php if (($this->params->get('show_author')) && ($this->item->author != "")) : ?>
            <span class="author">
                <?php JText::printf( 'Scritto da %s', ($this->item->created_by_alias ? $this->item->created_by_alias : $this->item->author) ); ?>
            </span>
            &#160;&#160;
        <?php endif; ?>

        <?php if ($this->params->get('show_create_date')) : ?>
            <span  class="createdate">
                <?php echo JHTML::_('date', $this->item->created, JText::_('DATE_FORMAT_LC2')); ?>
            </span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php  if (!$this->params->get('show_intro')) :
	echo $this->item->event->afterDisplayTitle;
endif; ?>
<?php echo $this->item->event->beforeDisplayContent; ?>
<div class="contentpaneopen<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<div class="cpocontent">
<?php if (($this->params->get('show_section') && $this->item->sectionid) || ($this->params->get('show_category') && $this->item->catid)) : ?>
<div>
	<div>
		<?php if ($this->params->get('show_section') && $this->item->sectionid && isset($this->item->section)) : ?>
		<span>
			<?php echo $this->item->section; ?>
				<?php if ($this->params->get('show_category')) : ?>
				<?php echo ' - '; ?>
			<?php endif; ?>
		</span>
		<?php endif; ?>

		<?php if ($this->params->get('show_category') && $this->item->catid) : ?>
		<span>
			<?php echo $this->item->category; ?>
		</span>
		<?php endif; ?>
 </div>
</div>
<?php endif; ?>


<?php if ($this->params->get('show_url') && $this->item->urls) : ?>
<div>
	<div>
		<a href="http://<?php echo $this->item->urls ; ?>" target="_blank">
			<?php echo $this->item->urls; ?></a>
 </div>
</div>
<?php endif; ?>

<div>
<?php if (isset ($this->item->toc)) : ?>
	<?php echo $this->item->toc; ?>
<?php endif; ?>
<?php echo JFilterOutput::ampReplace($this->item->text); ?>
</div>

<?php if ( intval($this->item->modified) != 0 && $this->params->get('show_modify_date')) : ?>
<div>
	<div class="modifydate">
		<?php echo JText::_( 'Last Updated' ); ?> ( <?php echo JHTML::_('date', $this->item->modified, JText::_('DATE_FORMAT_LC2')); ?> )
 </div>
</div>
<?php endif; ?>

<?php if ($this->item->params->get('show_readmore') && $this->item->readmore) : ?>
<div>
    <div>
        <a href="<?php echo $this->item->readmore_link; ?>" class="readon<?php echo $this->item->params->get('pageclass_sfx'); ?>">
            <?php if ($this->item->readmore_register) :
                echo JText::_('Register to read more...');
            elseif ($readmore = $this->item->params->get('readmore')) :
                echo $readmore;
            else :
                echo JText::sprintf('Read more', $this->item->title);
            endif; ?></a>
    </div>
</div>
<?php endif; ?>

</div>
</div>
</div>
<span class="article_separator">&#160;</span>
<?php echo $this->item->event->afterDisplayContent; ?>