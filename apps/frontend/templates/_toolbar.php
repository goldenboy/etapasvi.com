<?php $cur_url = preg_replace("/([^#?]+)[#?]?.*/", '$1', sfContext::getInstance()->getRequest()->getUri()); ?>

<div id="page_toolbar" class="small">    

    <a href="javascript:switchOfferTr('<?php echo url_for('offer_translation'); ?>', '<?php echo __('Error occured while loading form. Please, try again.') ?>')" id="offer_tr_trigger" class="page_tools_trigger" title="<?php echo __('Translate') ?>"><?php /*<i class="pt_btn pt_btn_offer_tr"></i>*/ ?><?php echo __('Translate') ?></a>
    <a href="javascript:switchEmbed()" id="embed_trigger" class="page_tools_trigger" title="<?php echo __('embed') ?>"><?php /*<i class="pt_btn pt_btn_embed"></i>*/ ?><?php echo __('Embed') ?></a>
    <a href="<?php echo $cur_url; ?>#print_version" target="_blank" id="print_version_trigger" class="page_tools_trigger" title="<?php echo __('print version') ?>"><?php /*<i class="pt_btn pt_btn_print_version"></i>*/?><?php echo __('Print version') ?></a>
    <a href="http://www.web2pdfconvert.com/engine.aspx?cURL=<?php echo $cur_url; ?>%23print_version" target="_blank" class="page_tools_trigger" title="<?php echo __('PDF') ?>"><?php /*<i class="pt_btn pt_btn_pdf"></i>*/ ?><?php echo __('PDF') ?></a>

    <?php /* должно быть между кнопками и блоками, т.к. в виде слота кнопку Revision history подключить не удалось */ ?>
    <?php include_component( 'revisionhistory', 'show' ); ?> 

    <div id="embed" class="page_tools box">        
        <textarea readonly="readonly">&lt;iframe width=&quot;604&quot; height=&quot;604&quot; src=&quot;<?php echo preg_replace("/([^#?]+)[#?]?.*/", '$1', sfContext::getInstance()->getRequest()->getUri()); ?>&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</textarea>
    </div>
    <?php include_component( 'text', 'offertranslation' ); ?>    

    <div id="lang_column"><!--UDLS-->     
    <?php 
        $app_domain_name = sfConfig::get('app_domain_name');
        $user_culture = $sf_user->getCulture();
        $uri          = $sf_request->getPathInfo();
        foreach( UserPeer::getCultures() as $culture) {
            $user_cultures[] = '/' . $culture . '/';
        }
        $params = str_replace( $user_cultures, '/', $uri);
        $user_cultures_data = UserPeer::getCulturesData();
        $i = 0;
    ?>
    <?php foreach($user_cultures_data as $culture => $culture_data): ?>                                
        <?php $i++ ?>
        <?php if ($i > count(UserPeer::getCultures())) break; ?>
        
        <?php if ($user_culture == $culture): ?>
            <strong title="<?php echo $culture_data['name'] ?>"><?php echo UserPeer::getCultureIso( $culture ) ?></strong>
        <?php else: ?>
            <a href="http://<?php echo $app_domain_name . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name'] ?>"><?php echo $culture_data['iso'] ?></a>
        <?php endif ?>
        <?php if ($i != count($user_cultures)): ?>
            |
        <?php endif ?>
    <?php endforeach?>
    <!--UDLE--></div>

</div>