<div id="embed" class="page_tools box">
    <a href="javascript:switchEmbed()" id="embed_trigger" class="page_tools_trigger">[<?php echo __('embed') ?>]</a>
    <textarea readonly="readonly">&lt;iframe width=&quot;604&quot; height=&quot;604&quot; src=&quot;<?php echo preg_replace("/([^#?]+)[#?]?.*/", '$1', sfContext::getInstance()->getRequest()->getUri()); ?>&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;</textarea>
</div>