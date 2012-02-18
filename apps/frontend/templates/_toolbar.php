<?php $cur_url = preg_replace("/([^#?]+)[#?]?.*/", '$1', sfContext::getInstance()->getRequest()->getUri()); ?>

<div id="page_toolbar">
    <a href="javascript:switchOfferTr('<?php echo url_for('offer_translation'); ?>', '<?php echo __('Error occured while loading form. Please, try again.') ?>')" id="offer_tr_trigger" class="page_tools_trigger" title="<?php echo __('offer translation') ?>"><i class="pt_btn pt_btn_offer_tr"></i></a>            
    <a href="javascript:switchEmbed()" id="embed_trigger" class="page_tools_trigger" title="<?php echo __('embed') ?>"><i class="pt_btn pt_btn_embed"></i></a>
    <a href="<?php echo $cur_url; ?>#print_version" target="_blank" id="print_version_trigger" class="page_tools_trigger" title="<?php echo __('print version') ?>"><i class="pt_btn pt_btn_print_version"></i></a>
    <a href="http://www.web2pdfconvert.com/engine.aspx?cURL=<?php echo $cur_url; ?>%23print_version" target="_blank" class="page_tools_trigger" title="<?php echo __('PDF') ?>"><i class="pt_btn pt_btn_pdf"></i></a>

    <?php /* должно быть между кнопками и блоками, т.к. в виде слота кнопку Revision history подключить не удалось */ ?>
    <?php include_component( 'revisionhistory', 'show' ); ?> 

    <div id="embed" class="page_tools box">        
        <textarea readonly="readonly">&lt;iframe width=&quot;604&quot; height=&quot;604&quot; src=&quot;<?php echo preg_replace("/([^#?]+)[#?]?.*/", '$1', sfContext::getInstance()->getRequest()->getUri()); ?>&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</textarea>
    </div>
    <?php include_component( 'text', 'offertranslation' ); ?>
</div>