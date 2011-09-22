<hr class="dashed audio_divider"/>
<?php foreach ($audio_list as $i=>$audio): ?>    
    <div>        
        <?php include_partial('audio/showShort', array('audio'=>$audio) ); ?>	
        <hr class="dashed audio_divider"/>
    </div>
<?php endforeach; ?>