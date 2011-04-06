<?php // no direct access
defined('_JEXEC') or die('Restricted access');

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
        <a href="<?php echo $this->article->readmore_link; ?>" class="contentpagetitle<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
            <h1><?php echo $this->article->title; ?></h1>
        </a>
        <?php else : ?>
            <h1><?php echo $this->article->title; ?></h1>
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
            <?php echo JHTML::_('icon.pdf', $this->article, $this->params, $this->access); ?>
            <?php endif; ?>
            <?php if ( $this->params->get( 'show_print_icon' )) : ?>
            <?php echo JHTML::_('icon.print_popup', $this->article, $this->params, $this->access); ?>
            <?php endif; ?>

            <?php if ($this->params->get('show_email_icon')) : ?>
            <?php echo JHTML::_('icon.email', $this->article, $this->params, $this->access); ?>
            <?php endif; ?>
        <?php else : ?>
            <?php echo JHTML::_('icon.print_screen',  $this->article, $this->params, $this->access); ?>
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
    <div>
        <?php if ($this->params->get('show_section') && $this->article->sectionid && isset($this->article->section)) : ?>
        <span>
            <?php echo $this->article->section; ?>
                <?php if ($this->params->get('show_category')) : ?>
                <?php echo ' - '; ?>
            <?php endif; ?>
        </span>
        <?php endif; ?>

        <?php if ($this->params->get('show_category') && $this->article->catid) : ?>
        <span>
            <?php echo $this->article->category; ?>
        </span>
        <?php endif; ?>
 </div>
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
