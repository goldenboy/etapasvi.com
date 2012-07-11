<span id="lang_plain"><!--UDLS-->
<?php 
    if (!$app_domain_name) {
        $app_domain_name = sfConfig::get('app_domain_name');
    }
    if (!$user_culture) {
        $user_culture = $sf_user->getCulture();
    }
    if (!$uri){
        $uri          = $sf_request->getPathInfo();
    }
    foreach( UserPeer::getCultures() as $culture) {
        $user_cultures[] = '/' . $culture . '/';
    }

    $params = str_replace( $user_cultures, '/', $uri);
    $user_cultures_data = UserPeer::getCulturesData();
    // всё, что идёт после #
    preg_match('/#.*$/', $uri, $matches);
    $i = 0;
?>
<?php foreach($user_cultures_data as $culture => $culture_data): ?>                                
    <?php $i++ ?>
    <?php if ($i > count(UserPeer::getCultures())) break; ?>
    
    <?php if ($user_culture == $culture): ?>
        <strong title="<?php echo $culture_data['name'] ?>" <?php if ($culture_data['large_text']):?>class="large_culture"<?php endif ?>><?php echo UserPeer::getCultureName( $culture ) ?></strong> 
    <?php else: ?>
        <a href="http://<?php echo $app_domain_name . '/'.$culture.$params; ?>" title="<?php echo $culture_data['name'] ?>" <?php if ($culture_data['large_text']): ?>class="large_culture"<?php endif ?>><?php echo $culture_data['name'] ?></a>
    <?php endif ?>
    <?php if ($i != count($user_cultures)): ?>
        |
    <?php endif ?>
<?php endforeach?>
<!--UDLE--><br/><br/></span>