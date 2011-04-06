<?php
/**
* This file is part of
* Joomla! 1.5 FAP
* @package   JoomlaFAP
* @version   $Id:$
* @author    Alessandro Pasotti
* @copyright    Copyright (C) 2007-2009 Alessandro Pasotti http://www.itopen.it
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
defined('_JEXEC') or die('Restricted access'); ?>
<?php if ($this->params->get('show_page_title')) : ?>
<div class="componentheading<?php echo $this->params->get('pageclass_sfx') ?>">
	<h1><?php echo $this->params->get('page_title'); ?></h1>
</div>
<?php endif; ?>
<div class="blog<?php echo $this->params->get('pageclass_sfx') ?>">
<?php

switch(strtolower(get_class($this))){
        case 'contentviewcategory':
            $description        = $this->category->description;
            $image              = $this->category->image;
            $image_position     = $this->category->image_position;
        break;
        case 'contentviewsection':
            $description        = $this->section->description;
            $image              = $this->section->image;
            $image_position     = $this->section->image_position;
        break;
        default:
            // Do nothing
        break;
    }
?>

<?php if (isset($description)) : ?>
<div>
        <?php if ($this->params->get('show_description_image') && $image_position) : ?>
                <img src="<?php echo $image; ?>" align="<?php echo $image_position; ?>" hspace="6" alt="" />
        <?php endif; ?>
        <?php if ($this->params->get('show_description') && $description) : ?>
                <?php echo $description; ?>
        <?php endif; ?>
</div>
<?php endif; ?>
<?php if ($this->params->def('num_leading_articles', 1)) :?>
<div>
	<?php for ($i = $this->pagination->limitstart; $i < $this->params->get('num_leading_articles'); $i++) : ?>
		<?php if ($i >= $this->total) : break; endif; ?>
		<div>
		<?php
			$this->item =& $this->getItem($i, $this->params);
			echo $this->loadTemplate('item');
		?><hr class="clear"/>
		</div>
	<?php endfor; ?>
</div>
<?php else : $i = $this->pagination->limitstart; endif; ?>

<?php if ($this->params->def('num_intro_articles', 4) && ($i < $this->total)) : ?>
<div>
		<?php
			$divider = '';
			//ABP: If we are not on first page...
			$pc = 'pages.current';
			$current_page = $this->pagination->$pc;
			if($current_page > 1){
				$prev_page_items = $this->params->get('num_leading_articles') + $this->params->get('num_intro_articles') * ($current_page - 1);
			} elseif($current_page == 1) {
				$prev_page_items = $this->params->get('num_leading_articles');
                        } else {
				$prev_page_items = '';
			}
			$numIntroArticles = $this->total - $prev_page_items;
			$numIntroArticles = $numIntroArticles < $this->params->get('num_intro_articles') ? $numIntroArticles : $this->params->get('num_intro_articles');
			//ABP: no columns if there aren't enough articles
			$num_columns = min($numIntroArticles, $this->params->def('num_columns', 2));
			for ($z = 0; $z < $num_columns; $z ++) :
				if ($z > 0) : $divider = " column_separator"; endif; ?>
				<div style="width:<?php echo intval(100 / $num_columns -1) ?>%" class="article_column<?php echo $divider ?>">
				<?php for ($y = 0; $y < $numIntroArticles / $num_columns; $y ++) :
					if ($i < $this->total) :
						$this->item =& $this->getItem($i, $this->params);
						echo $this->loadTemplate('item');
						$i ++;
					endif;
				endfor; ?>
				</div>
		<?php endfor; ?>
</div>
<?php endif; ?>

<?php if ($this->params->def('num_links', 4) && ($i < $this->total)) : ?>
    <div class="blog_more<?php echo $this->params->get('pageclass_sfx') ?>">
        <?php
            $this->links = array_splice($this->items, $i);
            echo $this->loadTemplate('links');
        ?>
    </div>
<?php endif; ?>

<?php if ($this->params->def('show_pagination', 2) == 1  || ($this->params->get('show_pagination') == 2 && $this->pagination->get('pages.total') > 1)) : ?>
<div class="pageslinks">
    <?php echo $this->pagination->getPagesLinks(); ?>
</div>
<?php if ($this->params->def('show_pagination_results', 1)) : ?>
<div class="pagescounter">
    <?php echo $this->pagination->getPagesCounter(); ?>
</div>
<?php endif; ?>
<?php endif; ?>
</div>
