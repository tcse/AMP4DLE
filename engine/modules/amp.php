<?PHP

/*
=====================================================
 DataLife Engine - by SoftNews Media Group 
-----------------------------------------------------
 http://dle-news.ru/
-----------------------------------------------------
 Copyright (c) 2004-2017 SoftNews Media Group
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Файл: amp.php
-----------------------------------------------------
 Разработчик: DomiTori
=====================================================
 Личный блог разработчика: https://domitori.ru/
-----------------------------------------------------
 Назначение: Модуль AMP для DLE
=====================================================
*/

    $tpl->load_template( 'amp.tpl' );
	
	// Формирование ссылки на полную новость
	
    if( $config['allow_alt_url'] )
    {
        if( $config['seo_type'] == 1 OR $config['seo_type'] == 2 )
        {
            if( $category_id AND $config['seo_type'] == 2 )
            {
                $c_url = get_url( $category_id );
                $full_link = $config['http_home_url'] . $c_url . "/" . $row['id'] . "-" . $row['alt_name'] . ".html";
            }
            else
                $full_link = $config['http_home_url'] . $row['id'] . "-" . $row['alt_name'] . ".html";
        }
        else
            $full_link = $config['http_home_url'] . date( 'Y/m/d/', $row['date'] ) . $row['alt_name'] . ".html";
    }
    else
        $full_link = $config['http_home_url'] . "index.php?newsid=" . $row['id'];
    $tpl->set('{full-link}', $full_link);
	
	// Формирование списка категорий
	
	if ($config['category_separator'] != ',') $config['category_separator'] = ' '.$config['category_separator'];

	if( ! $row['category'] ) {
		$my_cat = "---";
		$my_cat_link = "---";
	} else {
			
		$my_cat = array ();
		$my_cat_link = array ();
		$cat_list = explode( ',', $row['category'] );
		
		if( count( $cat_list ) == 1 ) {
				
			if( $allow_list[0] != "all" AND !in_array( $cat_list[0], $allow_list ) ) $perm = 0;

			if( $not_allow_cats[0] != "" AND in_array( $cat_list[0], $not_allow_cats ) ) $perm = 0;
				
			$my_cat[] = $cat_info[$cat_list[0]]['name'];
				
			$my_cat_link = get_categories( $cat_list[0], $config['category_separator'] );
			
		} else {
				
			foreach ( $cat_list as $element ) {
					
				if( $allow_list[0] != "all" AND !in_array( $element, $allow_list ) ) $perm = 0;
				
				if( $not_allow_cats[0] != "" AND in_array( $element, $not_allow_cats ) ) $perm = 0;
					
				if( $element ) {
					$my_cat[] = $cat_info[$element]['name'];
					if( $config['allow_alt_url'] ) $my_cat_link[] = "<a href=\"" . $config['http_home_url'] . get_url( $element ) . "/\">{$cat_info[$element]['name']}</a>";
					else $my_cat_link[] = "<a href=\"$PHP_SELF?do=cat&amp;category={$cat_info[$element]['alt_name']}\">{$cat_info[$element]['name']}</a>";
				}
			}
				
			$my_cat_link = implode( "{$config['category_separator']} ", $my_cat_link );
		}
			
		$my_cat = implode( "{$config['category_separator']} ", $my_cat );
	}
	
	$tpl->set( '[full-link]', "<a href=\"" . $full_link . "\">" );
	$tpl->set( '[/full-link]', "</a>" );
	
	// Обработка доп полей
	
    $xfields_amp = xfieldsdataload($row['xfields']);
    if(count($xfields_amp))
    {
        $xfieldsdata = $xfields_amp;
        foreach($xfields as $value)
        {
            $preg_safe_name = preg_quote($value[0], "'");
            if ($value[6] AND !empty($xfieldsdata[$value[0]]))
            {
                $temp_array = explode(",", $xfieldsdata[$value[0]]);
                $value3 = array();
                foreach($temp_array as $value2)
                {
                    $value2 = trim($value2);
                    $value2 = str_replace("&#039;", "'", $value2);
                    if ($config['allow_alt_url'])
                        $value3[] = "<a href=\"" . $config['http_home_url'] . "xfsearch/" . urlencode($value2) . "/\">" . $value2 . "</a>";
                    else
                        $value3[] = "<a href=\"$PHP_SELF?do=xfsearch&amp;xf=" . urlencode($value2) . "\">" . $value2 . "</a>";
                }

                $xfieldsdata[$value[0]] = implode(", ", $value3);
                unset($temp_array);
                unset($value2);
                unset($value3);
            }

            if (empty($xfieldsdata[$value[0]]))
            {
                $tpl->copy_template = preg_replace("'\\[xfgiven_{$preg_safe_name}\\](.*?)\\[/xfgiven_{$preg_safe_name}\\]'is", "", $tpl->copy_template);
                $tpl->copy_template = str_replace("[xfnotgiven_{$value[0]}]", "", $tpl->copy_template);
                $tpl->copy_template = str_replace("[/xfnotgiven_{$value[0]}]", "", $tpl->copy_template);
            }
            else
            {
                $tpl->copy_template = preg_replace("'\\[xfnotgiven_{$preg_safe_name}\\](.*?)\\[/xfnotgiven_{$preg_safe_name}\\]'is", "", $tpl->copy_template);
                $tpl->copy_template = str_replace("[xfgiven_{$value[0]}]", "", $tpl->copy_template);
                $tpl->copy_template = str_replace("[/xfgiven_{$value[0]}]", "", $tpl->copy_template);
            }

            $xfieldsdata[$value[0]] = stripslashes($xfieldsdata[$value[0]]);
        
            $tpl->copy_template = str_replace("[xfvalue_{$value[0]}]", $xfieldsdata[$value[0]], $tpl->copy_template);
        }
    }
		
	// Автор новости
		
	if( $config['allow_alt_url'] ) {
			
		$go_page = $config['http_home_url'] . "user/" . urlencode( $row['autor'] ) . "/";
		
	} else {
			
		$go_page = "$PHP_SELF?subaction=userinfo&amp;user=" . urlencode( $row['autor'] );
		
	}
	
	$tpl->set( '[profile]', "<a href=\"" . $go_page . "\">" );
	$tpl->set( '[/profile]', "</a>" );

	$tpl->set( '{login}', $row['autor'] );
	$tpl->set( '{views}', number_format($row['news_read'], 0, ',', ' ') );
	
	// Работаем с датой добавления новости
	
	$seo_data = str_replace(" ", "T", $row['date']);
	$mas_data = explode("T", $seo_data);
	$mass_data = explode("-", $mas_data[0]);
	$data = $mass_data[2].".".$mass_data[1].".".$mass_data[0];
	$tpl->set( '{date}', $data );
	$tpl->set( '{seo-date}', $seo_data );
		
	// Формирование различных тегов
	
	$tpl->set( '{title}', stripslashes( $row['title'] ) );
	if ($row['full_story']) {
		$tpl->set( '{full-story}', stripcslashes($row['full_story']) );
		$tpl->set( '{description}', substr(stripcslashes($row['full_story']), 0, 150) );
	}
	else {
		$tpl->set( '{full-story}', stripcslashes($row['short_story']) );
		$tpl->set( '{description}', substr(stripcslashes($row['short_story']), 0, 150) );
	}
	$tpl->set( '{link-category}', $my_cat_link );
	$tpl->set( '{site-name}', $config['home_title'] );
	$tpl->set( '{site-url}', $config['http_home_url'] );
	$tpl->set( '{THEME}', $config['http_home_url']."templates/".$config['skin'] );
	
	// Последние приготовления
	
    $tpl->compile('main');
    $tpl->clear();
    echo $tpl->result['main'];
    die();

?>