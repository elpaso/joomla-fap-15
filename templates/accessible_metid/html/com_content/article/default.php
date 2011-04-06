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
			return preg_replace('|onclick="(.*?)"|mus', 'onclick="\1" onkeypress="\1"', $html). '&nbsp;';
	}
}

// Tag level for item heading
$item_title_level = $this->params->get('show_page_title') ? '2' : '1';

?>
<?php if ($this->user->authorize('com_content', 'edit', 'content', 'all')) : ?>
    <div class="contentpaneopen_edit<?php echo $this->params->get( 'pageclass_sfx' ); ?>" style="float: left;">
        <?php echo JHTML::_('icon.edit', $this->article, $this->params, $this->access); ?>
    </div>
<?php endif; ?>

<?php if ($this->params->get('show_title') || $this->params->get('show_pdf_icon') || $this->params->get('show_print_icon') || $this->params->get('show_email_icon')) : ?>
<div class="contentpaneopen<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<div>
    <?php if ($this->params->get('show_title')) : ?>
    <div class="contentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
        <?php if ($this->params->get('link_titles') && $this->article->readmore_link != '') : ?>
        	<h<?php echo $item_title_level;?>><a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
            <?php echo $this->article->title; ?></a></h<?php echo $item_title_level;?>>
        <?php else : ?>
            <h<?php echo $item_title_level;?>><?php echo $this->article->title; ?></h<?php echo $item_title_level;?>>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    <?php if (
       $this->params->get('show_pdf_icon')
       || $this->params->get( 'show_print_icon' )
       || $this->params->get('show_email_icon')
       || $this->params->get('show_email_icon')
       || ($this->params->get('show_author') && ($this->article->author != ""))
       || $this->params->get('show_create_date')
       ) : ?>
    <div class="buttonheading">
        <?php if (!$this->print) : ?>
            <?php if ( $this->params->get( 'show_pdf_icon' )) : ?>
            <?php echo fix_keypress( JHTML::_('icon.pdf', $this->article, $this->params, $this->access)); ?>
            <?php endif; ?>
            <?php if ( $this->params->get( 'show_print_icon' )) : ?>
            <?php echo fix_keypress(JHTML::_('icon.print_popup', $this->article, $this->params, $this->access)); ?>
            <?php endif; ?>

            <?php if ($this->params->get('show_email_icon')) : ?>
            <?php echo fix_keypress(JHTML::_('icon.email', $this->article, $this->params, $this->access)); ?>
            <?php endif; ?>
        <?php else : ?>
            <?php echo fix_keypress(JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access)); ?>
        <?php endif; ?>
        <?php if (($this->params->get('show_author')) && ($this->article->author != "")) : ?>
            <span class="author">
                <?php JText::printf( 'Written by', ($this->article->created_by_alias ? $this->article->created_by_alias : $this->article->author) ); ?>
            </span>
            &#160;&#160;
        <?php endif; ?>

        <?php if ($this->params->get('show_create_date')) : ?>
            <span  class="createdate">
                <?php echo JHTML::_('date', $this->article->created, JText::_('DATE_FORMAT_LC2')); ?>
            </span>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
</div>
<?php endif; ?>
<?php  if (!$this->params->get('show_intro')) :
    echo $this->article->event->afterDisplayTitle;
endif; ?>
<?php echo $this->article->event->beforeDisplayContent; ?>
<div class="contentpaneopen<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if (($this->params->get('show_section') && $this->article->sectionid) || ($this->params->get('show_category') && $this->article->catid)) : ?>
<div>
    <div><?php // linee modficate da vales per attivare i link su sezioni e categorie  16.12.2008 ?>
        <?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
        <span>
            <?php if ($this->params->get('link_section')) : ?>
			      <a href="<?php echo JRoute::_(ContentHelperRoute::getSectionRoute($this->article->sectionid));?>">
	          <?php endif; ?>
            <?php echo $this->article->section; ?>
            <?php if ($this->params->get('link_section')) : ?>
			      </a>
	          <?php endif; ?>
            <?php if ($this->params->get('show_category')) : ?>
            <?php echo ' - '; ?>
            <?php endif; ?>
        </span>
        <?php endif; ?>

        <?php if ($this->params->get('show_category') && $this->article->catid) : ?>
        <span>
            <?php if ($this->params->get('link_category')) : ?>
			      <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($this->article->catslug, $this->article->sectionid)); ?>">
            <?php endif; ?>
            <?php echo $this->article->category; ?>
            <?php if ($this->params->get('link_category')) : ?>
			      </a>
	          <?php endif; ?>
        </span>
        <?php endif; ?>
	</div><?php // fine modifiche vales ?>
</div>
<?php endif; ?>


<?php if ($this->params->get('show_url') && $this->article->urls) : ?>
<div>
    <div>
        <a href="http://<?php echo $this->article->urls ; ?>" target="_blank">
            <?php echo $this->article->urls; ?></a>
 </div>
</div>
<?php endif; ?>

<div>
<div>
<?php if (isset ($this->article->toc)) : ?>
    <?php echo $this->article->toc; ?>
<?php endif; ?>
<?php echo ($this->article->text); ?>
</div>
</div>

<?php if ( intval($this->article->modified) != 0 && $this->params->get('show_modify_date')) : ?>
<div>
    <div class="modifydate">
        <?php echo JText::_( 'Last Updated' ); ?> ( <?php echo JHTML::_('date', $this->article->modified, JText::_('DATE_FORMAT_LC2')); ?> )
 </div>
</div>
<?php endif; ?>

<?php if ($this->params->get('show_readmore') && $this->article->readmore_text) : ?>
<div>
    <div>
        <a href="<?php echo $this->article->readmore_link; ?>" class="readon<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
            <?php echo $this->article->readmore_text; ?>
        </a>
 </div>
</div>
<?php endif; ?>

</div>
<span class="article_separator">&#160;</span>
<?php echo $this->article->event->afterDisplayContent; ?>