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

defined('_JEXEC') or die('Restricted access'); ?>
<?php if ( $this->params->def( 'show_page_title', 1 ) ) : ?>
	<div class="componentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
		<h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	</div>
<?php endif; ?>

<div style="margin:auto;width:100%;" class="contentpane<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php if ( @$this->category->image || @$this->category->description ) : ?>
<div class="contentdescription<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
<?php
    if ( isset($this->category->image) ) :  echo $this->category->image; endif;
    echo $this->category->description;
?>
</div>
<?php endif; ?>
<?php echo $this->loadTemplate('items'); ?>
<?php if ($this->params->get('show_other_cats', 1)): ?>
<ul>
<?php foreach ( $this->categories as $category ) : ?>
    <li>
        <a href="<?php echo $category->link; ?>" class="category<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
            <?php echo $this->escape($category->title);?></a>
        &nbsp;
        <span class="small">
            (<?php echo $category->numlinks;?>)
        </span>
    </li>
<?php endforeach; ?>
</ul>
<?php endif; ?>
</div>
