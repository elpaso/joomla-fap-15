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
$cparams =& JComponentHelper::getParams('com_media');
?>
<?php if ($this->params->get('show_page_title')) : ?>
<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
    <?php echo $this->escape($this->section->title); ?>
</div>
<?php endif; ?>
<?php // ABP: fixed XHTML attributes on table and td tags ?>
<div class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
    <?php if ($this->params->get('show_description_image') && $this->section->image) : ?>
        <img src="<?php echo $this->baseurl . '/' . $cparams->get('image_path') . '/'.  $this->section->image;?>" style="align:<?php echo $this->section->image_position;?>"  alt="<?php echo $this->section->image;?>" />
    <?php endif; ?>
    <?php if ($this->params->get('show_description') && $this->section->description) : ?>
        <?php echo $this->section->description; ?>
    <?php endif; ?>
</div>
<div>
    <?php if ($this->params->get('show_categories', 1)) : ?>
    <ul>
    <?php foreach ($this->categories as $category) : ?>
        <?php if (!$this->params->get('show_empty_categories') && !$category->numitems) continue; ?>
        <li>
            <a href="<?php echo $category->link; ?>" class="category">
                <?php echo $category->title;?></a>
            <?php if ($this->params->get('show_cat_num_articles')) : ?>
            &#160;
            <span class="small">
                ( <?php echo $category->numitems ." ". JText::_( 'items' );?> )
            </span>
            <?php endif; ?>
            <?php if ($this->params->def('show_category_description', 1) && $category->description) : ?>
            <br />
            <?php echo $category->description; ?>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
</div>
